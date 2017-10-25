<?php

namespace Resources;


use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;

/**
 * Class NumberTest
 * @package Resources
 */
class NumberTest extends BaseTestCase
{
    function testNumberList()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Number/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/numberListResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->numbers->getList();

        $this->assertRequest($request);

        self::assertNotNull($actual);

        self::assertGreaterThan(0, count($actual->get()));
    }

    function testNumberCreate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Number/',
            [
                "numbers"=>"11111",
                "carrier"=>"car",
                "region"=>"IN"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/numberCreateResponse.json');

        $this->mock(new PlivoResponse($request,201, $body));

        $actual = $this->client->numbers->addNumber(['11111'], "car", "IN");

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testNumberGet()
    {
        $number = 'sadasdasd';
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Number/' . $number . '/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/numberGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->numbers->get($number);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testNumberUpdate()
    {
        $number = 'sadasdasd';
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Number/' . $number . '/',
            ['alias'=>'saila']);
        $body = file_get_contents(__DIR__ . '/../Mocks/numberUpdateResponse.json');

        $this->mock(new PlivoResponse($request,203, $body));

        $actual = $this->client->numbers->update($number, ['alias'=>'saila']);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }
    
    function testNumberDelete()
    {
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/Number/cxcxcx/',
            []);
        $body = '{}';
        
        $this->mock(new PlivoResponse($request,200, $body));
        
        $actual = $this->client->numbers->delete("cxcxcx");
        
        $this->assertRequest($request);
        
        self::assertNull($actual);
    }
}