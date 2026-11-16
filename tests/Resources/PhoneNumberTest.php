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

    function testPhoneNumberListExposesInrRatesForInrAccount()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/',
            ['country_iso'=>'US']);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberListInrResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $numbers = $this->client->phoneNumbers->list('US')->get();

        $this->assertRequest($request);

        self::assertEquals('0.80000', $numbers[0]->monthlyRentalRate);
        self::assertEquals('0.00000', $numbers[0]->setupRateINR);
        self::assertEquals('66.80000', $numbers[0]->monthlyRentalRateINR);
        self::assertEquals('0.66800', $numbers[0]->smsRateINR);
        self::assertEquals('0.62625', $numbers[0]->mmsRateINR);
        self::assertEquals('0.41750', $numbers[0]->voiceRateINR);

        self::assertEquals('0.80000', $numbers[1]->monthlyRentalRate);
        self::assertNull($numbers[1]->setupRateINR);
        self::assertNull($numbers[1]->monthlyRentalRateINR);
        self::assertNull($numbers[1]->smsRateINR);
        self::assertNull($numbers[1]->mmsRateINR);
        self::assertNull($numbers[1]->voiceRateINR);
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

    function testPhoneNumberBuyWithComplianceApplicationId()
    {
        $number = 'sadasdasd';
        $complianceApplicationId = 'COMPLIANCE123456789';
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/' . $number . '/',
            ['compliance_application_id' => $complianceApplicationId]);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberCreateResponse.json');

        $this->mock(new PlivoResponse($request,201, $body));

        $actual = $this->client->phoneNumbers->buy($number, null, null, null, $complianceApplicationId);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }
}