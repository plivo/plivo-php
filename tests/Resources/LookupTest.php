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
            'Number/'.$number.'?type=carrier',
            []
        );
        $body = file_get_contents(__DIR__ . '/../Mocks/lookupGetResponse.json');
        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->lookup->get($number);
        $this->assertRequest($request);

        self::assertNotNull($actual);
        self::assertEquals($actual["phone_number"], $number);
        self::assertEquals($actual["format"]["e164"], $number);
        self::assertEquals($actual["resource_uri"], "/v1/Number/+14154305555?type=carrier");
    }
}
