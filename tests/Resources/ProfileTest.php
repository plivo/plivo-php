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

    public function testCampaignCreate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Profile/',
            [
            
                    "profile_alias" => "vishnu109",
                    "profile_type"=> "SECONDARY",
                    "customer_type"=> "RESELLER",
                    "entity_type"=> "PRIVATE_PROFIT",
                    "company_name"=> "ABC Inc.",
                    "ein" => "111111111",
                    "vertical" => "PROFESSIONAL",
                    "ein_issuing_country" => "US",
                    "address" => {
                        "street" =>"123",
                        "city" => "New York",
                        "state" => "NY",
                        "postal_code" => "10001",
                        "country" => "IN"
                    },
                    "stock_symbol" => "ABC",
                    "stock_exchange" => "NASDAQ",
                    "alt_business_id_type" => "NONE",
                    "authorized_contact" => {
                        "first_name" => "John",
                        "last_name" => "Doe",
                        "email" => "johndoe.com",
                        "title" => "Doe",
                        "seniority" => "admin"
                    }
                
                ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/profileCreateResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        // $actual = $this->client->profile->create("B8OD95Z", "campaign name sssample","INSURANCE", "MIXED", [
        //     "CUSTOMER_CARE",
        //     "2FA"
        // ], "sample description text", False, False, False, False, True, True, True, "test 1", "test 2");

        // $this->assertRequest($request);

        // self::assertNotNull($actual);
    }

    // public function testGetCampaign()
    // {
    //     $campaignID = "CMPT4EP";
    //     $request = new PlivoRequest(
    //         'GET',
    //         'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Campaign/'.$campaignID.'/',
    //         []);
    //     $body = file_get_contents(__DIR__ . '/../Mocks/campaignGetResponse.json');

    //     $this->mock(new PlivoResponse($request,200, $body));

    //     $actual = $this->client->campaign->get($campaignID);
    //     self::assertNotNull($actual);
    //     $this->assertRequest($request);

    // }
   
    
    // function testCampaignList()
    // {
    //     $request = new PlivoRequest(
    //         'Get',
    //         'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Campaign/',
    //         []);
    //     $body = file_get_contents(__DIR__ . '/../Mocks/campaignListResponse.json');
        
    //     $this->mock(new PlivoResponse($request,202, $body));
        
    //     $actual = $this->client->campaign->list();
        
    //     $this->assertRequest($request);
        
    //     self::assertNotNull($actual);
    }

}