<?php

namespace Resources;


use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;

/**
 * Class ApplicationTest
 * @package Resources
 */
class ApplicationTest extends BaseTestCase
{
    function testApplicationCreate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Application/',
            [
                'app_name' => 'app'
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/applicationCreateResponse.json');

        $this->mock(new PlivoResponse($request,201, $body));

        $actual = $this->client->applications->create('app');
        $this->assertRequest($request);

        self::assertNotNull($actual);

        foreach ($actual as $actualApplication) {
            self::assertEquals(substr($actualApplication->resourceUri, 0, 33), "/v1/Account/MAXXXXXXXXXXXXXXXXXX/");
        }
    }

    function testApplicationList()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Application/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/applicationListResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->applications->list;

        $this->assertRequest($request);

        self::assertNotNull($actual);

        foreach ($actual as $actualApplication) {
            self::assertEquals(substr($actualApplication->resourceUri, 0, 33), "/v1/Account/MAXXXXXXXXXXXXXXXXXX/");
        }
    }

    function testApplicationDetails()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Application/20468599130939380/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/applicationGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->applications->get("20468599130939380");

        $this->assertRequest($request);

        self::assertNotNull($actual);

        self::assertEquals($actual->getId(), "20468599130939380");
    }

    function testApplicationUpdate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Application/app/',
            [
                'subaccount' => "name"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/applicationModifyResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->applications->update("app", ['subaccount'=>'name']);

        $this->assertRequest($request);

        self::assertNotNull($actual);

        self::assertEquals($actual->message, "changed");
    }
}