<?php

namespace Resources;


use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;

class ZentrunkCallTest extends BaseTestCase{
    function testZentrunkCallList(){
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Call/',
            [
                'limit' => 2,
                'offset' => 2
            ]
        );
        $body = file_get_contents(__DIR__ . '/../Mocks/zentrunkCallsListResponse.json');
        
        $this->mock(new PlivoResponse($request,200, $body));
        
        $actual = $this->client->ZentrunkCalls->list([
            'limit' => 2,
            'offset' => 2
        ]);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }
}