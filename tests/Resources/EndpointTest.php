<?php

namespace Resources;


use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;

/**
 * Class EndpointTest
 * @package Resources
 */
class EndpointTest extends BaseTestCase
{
    function testEndpointCreate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Endpoint/',
            [
                "username" => "carter",
                "password" => "retrac",
                "alias" => "mario"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/endpointCreateResponse.json');

        $this->mock(new PlivoResponse($request,201, $body));

        $actual = $this->client->endpoints->create(
            "carter", "retrac", "mario"
        );

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testEndpointGet()
    {
        $endpoint = "lalalala";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Endpoint/' . $endpoint . '/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/endpointGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->endpoints->get($endpoint);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testEndpointList()
    {
        $request = new PlivoRequest(
            'Get',
            'Account/MAXXXXXXXXXXXXXXXXXX/Endpoint/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/endpointListResponse.json');

        $this->mock(new PlivoResponse($request,202, $body));

        $actual = $this->client->endpoints->list;

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testEndpointUpdate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Endpoint/carter/',
            [
                "alias" => "hahaha"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/endpointUpdateResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->endpoints->update(
            "carter", ['alias' => 'hahaha']);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }
    
    function testEndpointDelete()
    {
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/Endpoint/cxcxcx/',
            []);
        $body = '{}';
        
        $this->mock(new PlivoResponse($request,200, $body));
        
        $actual = $this->client->endpoints->delete("cxcxcx");
        
        $this->assertRequest($request);
        
        self::assertNull($actual);
    }
}