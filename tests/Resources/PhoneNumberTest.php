<?php

namespace Resources;


use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;

/**
 * Class PhoneNumberTest
 * @package Resources
 */
class PhoneNumberTest extends BaseTestCase
{
    function testPhoneNumberList()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/',
            ['country_iso'=>'IN']);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberListResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->phoneNumbers->list('IN');

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testPhoneNumberCreate()
    {
        $number = 'sadasdasd';
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/' . $number . '/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberCreateResponse.json');

        $this->mock(new PlivoResponse($request,201, $body));

        $actual = $this->client->phoneNumbers->buy($number);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }
}