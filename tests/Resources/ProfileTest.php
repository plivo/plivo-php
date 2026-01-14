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

    function testProfileCreate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Profile/',
            [
                'profile_alias' => 'Test Profile',
                'plivo_subaccount' => '',
                'customer_type' => 'DIRECT',
                'entity_type' => 'PUBLIC',
                'company_name' => 'Test Company Inc',
                'ein' => '12-3456789',
                'vertical' => 'TECHNOLOGY',
                'ein_issuing_country' => 'US',
                'stock_symbol' => 'TEST',
                'stock_exchange' => 'NASDAQ',
                'website' => 'https://testcompany.com',
                'alt_business_id_type' => 'NONE',
                'business_contact_email' => 'employee@company.com',
                'address' => [
                    'street' => '123 Main Street',
                    'city' => 'San Francisco',
                    'state' => 'CA',
                    'postal_code' => '94105',
                    'country' => 'US'
                ],
                'authorized_contact' => [
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'phone' => '+14155551234',
                    'email' => 'test@example.com',
                    'title' => 'CEO',
                    'seniority' => 'C_LEVEL'
                ]
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/profileCreateResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->profile->create(
            'Test Profile',
            '',
            'DIRECT',
            'PUBLIC',
            'Test Company Inc',
            '12-3456789',
            'TECHNOLOGY',
            'US',
            'TEST',
            'NASDAQ',
            'NONE',
            'https://testcompany.com',
            [
                'street' => '123 Main Street',
                'city' => 'San Francisco',
                'state' => 'CA',
                'postal_code' => '94105',
                'country' => 'US'
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone' => '+14155551234',
                'email' => 'test@example.com',
                'title' => 'CEO',
                'seniority' => 'C_LEVEL'
            ],
            'employee@company.com'
        );

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }
}