<?php

namespace Plivo\Tests\Resources;




use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;


/**
 * Class MessageTest
 * @package Plivo\Tests\Resources
 */
class BrandTest extends BaseTestCase {

    public function testBrandCreate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Brand/',
            [
                'alt_business_id_type' => "GIIN",
                'alt_business_id' => "111",
                'city' => "New York",
                'company_name' => "ABC Inc.",
                'country' => "US",
                'ein' => "111111111",
                'ein_issuing_country' => "US",
                'email' => "johndoe@abc.com",
                'entity_type' => "PRIVATE_PROFIT",
                'first_name' => "John",
                'last_name' => "Doe",
                'phone' => "+11234567890",
                'postal_code' => "10001",
                'registration_status' => "PENDING",
                'state' => "NY",
                'stock_exchange' => "NASDAQ",
                'stock_symbol' => "ABC",
                'street' => "123",
                'vertical' => "RETAIL",
                'website' => "http://www.abcmobile.com"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/brandCreationResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->brand->create("New York", "ABC Inc.","US", "111111111", "US", "johndoe@abc.com", "PRIVATE_PROFIT","+11234567890","10001", "PENDING", "NY", "NASDAQ", "ABC", "123", "RETAIL");

        self::assertNotNull($actual);
    }

    public function testGetBrand()
    {
        $brandID = "BRPXS6E";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Brand/'.$brandID.'/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/brandGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->brand->get($brandID);
        self::assertNotNull($actual);
        $this->assertRequest($request);

    }
   
    
    function testBrandList()
    {
        $request = new PlivoRequest(
            'Get',
            'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Brand/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/campaignListResponse.json');
        
        $this->mock(new PlivoResponse($request,202, $body));
        
        $actual = $this->client->brand->list();
        
        $this->assertRequest($request);
        
        self::assertNotNull($actual);
    }

}