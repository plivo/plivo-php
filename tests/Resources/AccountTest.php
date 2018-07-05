<?php

namespace Resources;


use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;


/**
 * Class AccountTest
 * @package Plivo\Tests\Resources
 */
class AccountTest extends BaseTestCase
{
    /**
     *
     */
    function testAccountGetDetails()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/accountGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->accounts->get();

        $this->assertRequest($request);

        self::assertNotNull($actual);

        self::assertEquals($actual->authId, "MAXXXXXXXXXXXXXXXXXX");
    }

    function testAccountModify()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/',
            [
                'name' => "name",
                'city' => "city",
                'address' => "address"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/accountModifyResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->accounts->update("name", "city", "address");

        $this->assertRequest($request);

        self::assertNotNull($actual);

        self::assertEquals($actual->message, "changed");
        self::assertEquals($actual->apiId, "964edb6e-3f08-11e7-920b-0600a1193e9b");
    }
}