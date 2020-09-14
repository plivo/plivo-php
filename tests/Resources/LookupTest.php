<?php

namespace Plivo\Tests\Resources;

use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;

/**
 * Class LookupTest
 * @package Plivo\Tests\Resources
 */
class LookupTest extends BaseTestCase
{

    public function testLookupGet()
    {
        $number = "+14154305555";
        $request = new PlivoRequest(
            'GET',
            'Lookup/Number/'.$number.'?info=service_provider',
            []
        );
        $body = file_get_contents(__DIR__ . '/../Mocks/lookupGetResponse.json');
        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->lookup->get($number);
        $this->assertRequest($request);

        self::assertNotNull($actual);
        self::assertEquals($actual["number_format"]["e164"], $number);
    }
}
