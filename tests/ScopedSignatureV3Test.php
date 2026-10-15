<?php

use PHPUnit\Framework\TestCase;
use Plivo\Util\v3SignatureValidation;

class ScopedSignatureV3Test extends TestCase
{
    const NONCE = '01456268273535255990';
    const POST_URL = 'https://acme.example.com/sms/status';
    const POST_SIG = 'Kxo1ZuQEWE578HnfEhiJvLjXNzZXYPvkZDKNq9s4kvk=';
    const GET_URL = 'https://acme.example.com/answer?From=14155550100&CallUUID=abc';
    const GET_SIG = 'nr+QWHZTVoEP0rWEEWMeWjgKRzfOOuBhJvJqQQ8ZC2s=';
    const AUTH_TOKEN = 'test-auth-token';

    private static function token1() { return 'PLV' . 'obLD1OX2BxgpOktcbX6PkBEiM0RVZneImaq7zN3u_wA'; }
    private static function token2() { return 'PLV' . str_repeat('A', 43); }

    private static function postParams($status = 'delivered')
    {
        return array('MessageUUID' => '6f1c2a90-0d7e-4b1e-9c11-1d2e3f4a5b6c', 'Status' => $status, 'To' => '14155550100');
    }

    function testDeriveSigningKey()
    {
        self::assertEquals('e55b316ef14f5830de74d2cc2ae794b87c6c349f577d2fabd648884afba6c7ca', bin2hex(v3SignatureValidation::deriveSigningKey(self::token1())));
        self::assertEquals('c89d8ad56ac99e1a8def8cecce07ffb55332fe813673be81df8b1297d1206368', bin2hex(v3SignatureValidation::deriveSigningKey(self::token2())));
    }

    function testValidPostAndGet()
    {
        self::assertTrue(v3SignatureValidation::validateV3SignatureScoped('POST', self::POST_URL, self::NONCE, self::token1(), self::POST_SIG, self::postParams()));
        self::assertTrue(v3SignatureValidation::validateV3SignatureScoped('GET', self::GET_URL, self::NONCE, self::token1(), self::GET_SIG));
    }

    function testRejectsWrongTokenOrTamperedParams()
    {
        self::assertFalse(v3SignatureValidation::validateV3SignatureScoped('POST', self::POST_URL, self::NONCE, self::token2(), self::POST_SIG, self::postParams()));
        self::assertFalse(v3SignatureValidation::validateV3SignatureScoped('POST', self::POST_URL, self::NONCE, self::token1(), self::POST_SIG, self::postParams('failed')));
    }

    function testAcceptsAnyOfMultipleSignatures()
    {
        self::assertTrue(v3SignatureValidation::validateV3SignatureScoped('POST', self::POST_URL, self::NONCE, self::token1(), 'bogus,' . self::POST_SIG, self::postParams()));
    }

    private static function authSig()
    {
        $compute = new ReflectionMethod(v3SignatureValidation::class, 'computeV3Signature');
        $compute->setAccessible(true);
        return $compute->invoke(null, 'POST', self::POST_URL, self::NONCE, self::AUTH_TOKEN, self::postParams());
    }

    private static function validateKeys($signature, $keys)
    {
        return v3SignatureValidation::validateV3SignatureScoped('POST', self::POST_URL, self::NONCE, $keys, $signature, self::postParams());
    }

    function testKeyListAcceptsScopedOrAuthTokenSignature()
    {
        self::assertTrue(self::validateKeys(self::POST_SIG, array(self::token1(), self::AUTH_TOKEN)));
        self::assertTrue(self::validateKeys(self::authSig(), array(self::token1(), self::AUTH_TOKEN)));
        self::assertTrue(self::validateKeys(self::POST_SIG . ',' . self::authSig(), array(self::token2(), self::AUTH_TOKEN)));
    }

    function testKeyListRejectsWhenNoKeyMatches()
    {
        self::assertFalse(self::validateKeys(self::POST_SIG, array(self::token2())));
        self::assertFalse(self::validateKeys(self::POST_SIG, array()));
    }

    function testKeyListSkipsNullAndEmptyEntries()
    {
        self::assertTrue(self::validateKeys(self::POST_SIG, array(null, '', self::token1())));
    }

    function testAuthTokenValidatorRejectsScopedSignature()
    {
        self::assertFalse(v3SignatureValidation::validateV3Signature('POST', self::POST_URL, self::NONCE, self::token1(), self::POST_SIG, self::postParams()));
    }
}
