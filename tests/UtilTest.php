<?php

use Plivo\Tests\BaseTestCase;
use Plivo\Util\signatureValidation;
use Plivo\Util\AccessToken;


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

    function testJWT()
    {
        $acctkn = new AccessToken('MADADADADADADADADADA', 'qwerty', 'username', 12121212, 300, null, 'username-12345');
        $acctkn->addVoiceGrants(true, true);
        self::assertEquals('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImN0eSI6InBsaXZvO3Y9MSJ9.eyJqdGkiOiJ1c2VybmFtZS0xMjM0NSIsImlzcyI6Ik1BREFEQURBREFEQURBREFEQURBIiwic3ViIjoidXNlcm5hbWUiLCJuYmYiOjEyMTIxMjEyLCJleHAiOjEyMTIxNTEyLCJncmFudHMiOnsidm9pY2UiOnsiaW5jb21pbmdfYWxsb3ciOnRydWUsIm91dGdvaW5nX2FsbG93Ijp0cnVlfX19.khM99-sYP2AylLo9y6bwNnJbVPjjtOMAimiFvNo7FGA', $acctkn->toJwt());
    }
}
