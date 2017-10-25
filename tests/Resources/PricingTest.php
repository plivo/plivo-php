<?php

namespace Resources;


use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;

/**
 * Class PricingTest
 * @package Resources
 */
class PricingTest extends BaseTestCase
{
    function testPricingGet()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Pricing/',
            ['country_iso' => 'US']);
        $body = file_get_contents(__DIR__ . '/../Mocks/pricingGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->pricing->get('US');

        $this->assertRequest($request);

        self::assertNotNull($actual);

        self::assertEquals("US", $actual->countryIso);
        self::assertEquals("0.00650", $actual->message->outbound->rate);
        self::assertEquals("0.00300", $actual->voice->outbound['ip']['rate']);
        self::assertNotEquals("0.00650", $actual->phoneNumbers->local->rate);
    }
}