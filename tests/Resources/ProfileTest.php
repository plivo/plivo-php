<?php

namespace Plivo\Tests\Resources;




use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;


/**
 * Class ProfileTest
 * @package Plivo\Tests\Resources
 */
class ProfileTest extends BaseTestCase {

    function testProfileGet()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Profile/06ecae31-4bf8-40b9-ac62-e902418e9935/', []);
        $body = file_get_contents(__DIR__ . '/../Mocks/profileGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->profile->get('06ecae31-4bf8-40b9-ac62-e902418e9935');

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testProfileList()
    {
        $request = new PlivoRequest(
            'Get',
            'Account/MAXXXXXXXXXXXXXXXXXX/Profile/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/profileListResponse.json');
        
        $this->mock(new PlivoResponse($request,202, $body));
        
        $actual = $this->client->profile->list();
        
        $this->assertRequest($request);
        
        self::assertNotNull($actual);
    }

    function testProfileDelete()
    {
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/Profile/06ecae31-4bf8-40b9-ac62-e902418e9935/', []);
        $body = file_get_contents(__DIR__ . '/../Mocks/profileDeleteResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->profile->delete('06ecae31-4bf8-40b9-ac62-e902418e9935');

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }
}