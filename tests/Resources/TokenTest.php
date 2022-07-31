<?php

namespace Plivo\Tests\Resources;




use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;


/**
 * Class TokenTest
 * @package Plivo\Tests\Resources
 */
class TokenTest extends BaseTestCase
{

    function testTokenCreate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/JWT/Token/',
            [
                'iss'=> "iss",
                'sub'=> "kowshik"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/tokenCreateResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->token->create("MAXXXXXXXXXXXXXXXXXX");

        self::assertNotNull($actual);
        self::assertEquals($actual->token, "eyJhbGciOiJIUzI1NiIsImN0eSI6InBsaXZvO3Y9MSIsInR5cCI6IkpXVCJ9.eyJhcHAiOiIiLCJleHAiOjE2NTg3ODU4ODUsImlzcyI6Ik1BTURWTFpKWTJaR1k1TVdVMVpKIiwibmJmIjoxNjU4Njk5NDg1LCJwZXIiOnsidm9pY2UiOnsiaW5jb21pbmdfYWxsb3ciOmZhbHNlLCJvdXRnb2luZ19hbGxvdyI6ZmFsc2V9fSwic3ViIjoiS293c2hpayJ9.iWwtfH9QNO7nIE_HK0GSJ3U81oRQR9gcUScrPixBK_s");
        self::assertEquals($actual->apiId, "c3a4d6c0-0b9a-11ed-9fa2-0242ac110004");
    }
}