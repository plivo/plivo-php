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

        $numbers = $actual->get();
        self::assertEquals('SAXXXXXXXXXXXXXXXXXX', $numbers[0]->subAccount);
        self::assertEquals('Marketing', $numbers[0]->subAccountName);
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

    function testNumberGetExposesInrRatesForInrAccount()
    {
        $number = '17609915566';
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Number/' . $number . '/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/numberGetInrResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->numbers->get($number);

        $this->assertRequest($request);

        self::assertEquals('0.80000', $actual->monthlyRentalRate);
        self::assertEquals('66.80000', $actual->monthlyRentalRateINR);
        self::assertEquals('0.00000', $actual->smsRateINR);
        self::assertEquals('0.62625', $actual->mmsRateINR);
        self::assertEquals('0.70975', $actual->voiceRateINR);
    }

    function testNumberGetReturnsNullInrRatesForUsdAccount()
    {
        $number = '17609915566';
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Number/' . $number . '/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/numberGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->numbers->get($number);

        self::assertEquals('0.80000', $actual->monthlyRentalRate);
        self::assertNull($actual->monthlyRentalRateINR);
        self::assertNull($actual->smsRateINR);
        self::assertNull($actual->mmsRateINR);
        self::assertNull($actual->voiceRateINR);
    }

    function testNumberListExposesInrRatesPerNumber()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Number/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/numberListInrResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $numbers = $this->client->numbers->getList()->get();

        $this->assertRequest($request);

        self::assertEquals('66.80000', $numbers[0]->monthlyRentalRateINR);
        self::assertEquals('0.00000', $numbers[0]->smsRateINR);
        self::assertEquals('0.62625', $numbers[0]->mmsRateINR);
        self::assertEquals('0.70975', $numbers[0]->voiceRateINR);

        self::assertNull($numbers[1]->monthlyRentalRateINR);
        self::assertNull($numbers[1]->smsRateINR);
        self::assertNull($numbers[1]->mmsRateINR);
        self::assertNull($numbers[1]->voiceRateINR);
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