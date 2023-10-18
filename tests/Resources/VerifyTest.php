<?php

namespace Plivo\Tests\Resources;

use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;


/**
 * Class VerifyTest
 * @package Plivo\Tests\Resources
 */

 class VerifyTest extends BaseTestCase {

    public function testInitiateVerify()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/VerifiedCallerId/',
            [
                "phone_number" => "+919999999999"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/initiateVerifyResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));
        $actual = $this->client->initiate("+919999999999");
        self::assertNotNull($actual);
    }

    public function testVerify()
    {   
        $verificationUuid = '605c75f2-02b6-4cb8-883d-69cf37b21e5a';
        $otp = "999999";
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/VerifiedCallerId/'.$verificationUuid.'/',
            [
                "otp" => "999999"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/verifyCallerIdResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));
        $actual = $this->client->verify($otp);
        self::assertNotNull($actual);
    }

    public function testUpdateVerifiedCallerId()
    {   
        $phoneNumber = "+919999999999";
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/VerifiedCallerId/'.$phoneNumber.'/',
            [
                "alias" => "test-2"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/updateVerifiedCallerIdResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));
        $actual = $this->client->updateVerifiedCallerId($phoneNumber,"test-2");
        self::assertNotNull($actual);
    }

    public function testGetVerifiedCallerId()
    {
        $phoneNumber = "+919999999999";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/VerifiedCallerId/'.$phoneNumber.'/',
            [
                "phoneNumber" => "+919999999999"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/updateVerifiedCallerIdResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));
        $actual = $this->client->getVerifiedCallerId($phoneNumber);
        self::assertNotNull($actual);
    }
 
}
