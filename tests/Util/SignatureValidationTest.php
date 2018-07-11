<?php

namespace Plivo\Tests\Util;

use Plivo\Tests\BaseTestCase;
use Plivo\Util\SignatureValidation;


/**
 * Class SignatureValidationTest
 * @package Plivo\Tests\Resources
 */
class SignatureValidationTest extends BaseTestCase
{
    function testSignatureValid()
    {
        $result = SignatureValidation::validateSignature('https://answer.url', '12345', 'ehV3IKhLysWBxC1sy8INm0qGoQYdYsHwuoKjsX7FsXc=', 'my_auth_token');
        $this->assertSame(true, $result);
    }

    function testSignatureInvalid()
    {
        $result = SignatureValidation::validateSignature('https://answer.url', '12345', 'ehV3IKhLysWBxC1sy8INm0qGoQYdYsHwuoKjsX7FsXc=', 'invalidtoken');
        $this->assertSame(false, $result);
    }
}
