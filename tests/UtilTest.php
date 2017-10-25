<?php

use Plivo\Tests\BaseTestCase;
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
}
