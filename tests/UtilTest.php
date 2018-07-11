<?php

namespace Plivo\Tests;

use GuzzleHttp\Psr7\Request;
use Plivo\Util\signatureValidation;


/**
 * Class signatureValidationTest
 * @package Plivo\Tests\Resources
 */
class UtilTest extends BaseTestCase
{
    function testSignatureValid()
    {
        $SVUtil = new signatureValidation();
        $output = $SVUtil->validateSignature('https://answer.url','12345','ehV3IKhLysWBxC1sy8INm0qGoQYdYsHwuoKjsX7FsXc=','my_auth_token');
        self::assertEquals($output,True);
    }

    function testSignatureInvalid()
    {
        $SVUtil = new signatureValidation();
        $output = $SVUtil->validateSignature('https://answer.url','12345','ehV3IKhLysWBxC1sy8INm0qGoQYdYsHwuoKjsX7FsXc=','my_auth_tokens');
        self::assertEquals($output,False);
    }

    function testRequestValid()
    {
        $request = new Request('GET', 'https://answer.url/callback?a=b', [
            'X-Plivo-Signature-V2' => 'K35dKDFR7qol4IYq+4/3qx2+KVXUWF/mHJg3Pxp7VAo=',
            'X-Plivo-Signature-V2-Nonce' => '12345',
        ]);

        self::assertSame(true, signatureValidation::validateRequest('my_auth_token', $request));
    }

    function testRequestInvalid()
    {
        self::assertSame(false, signatureValidation::validateRequest('my_auth_token'));
    }
}
