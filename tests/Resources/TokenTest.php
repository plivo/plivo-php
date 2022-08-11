<?php

namespace Resources;


use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;

/**
 * Class EndpointTest
 * @package Resources
 */
class TokenTest extends BaseTestCase
{
    function testEndpointCreate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/JWT/Token/',
            [
                "iss" => "MAXXXXXXXXXXXXXXXXXX"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/tokenCreteResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->token->create(
            "MAXXXXXXXXXXXXXXXXXX"
        );

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }
}