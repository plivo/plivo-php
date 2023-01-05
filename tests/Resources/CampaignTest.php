<?php

namespace Plivo\Tests\Resources;




use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;


/**
 * Class CampaignTest
 * @package Plivo\Tests\Resources
 */
class CampaignTest extends BaseTestCase {

    public function testCampaignCreate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Campaign/',
            [
                'brand_id' => "B8OD95Z",
                'campaign_alias' => "campaign name sssample",
                'vertical' => "INSURANCE",
                'usecase' => "MIXED",
                'sub_usecases' => [
                    "CUSTOMER_CARE",
                    "2FA"
                ],
                'description' => "sample description text should be minimum 40 character",
                'embedded_link' => False,
                'embedded_phone' => False,
                'age_gated' => False,
                'direct_lending' => False,
                'subscriber_optin' => True,
                'subscriber_optout' => True,
                'subscriber_help' => True,
                'affiliate_marketing' => False,
                'sample1' => "sample 1 should be 20 minimum character",
                'sample2' => "sample 2 should be 20 minimum character",
                'message_flow' => "message_flow should be 20 minimum character",
                'help_message' => "help_message should be 20 minimum character",
                'optout_message' => "optout_message should be 20 minimum character"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/campaignCreationResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->campaign->create("B8OD95Z", "campaign name sssample","INSURANCE", "MIXED", [
            "CUSTOMER_CARE",
            "2FA"
        ], "sample description text should be minimum 40 character", False, False, False, False, True, True, True, False, "sample 1 should be 20 minimum character", "sample 2 should be 20 minimum character", "message_flow should be 20 minimum character", "help_message should be 20 minimum character", "optout_message should be 20 minimum character");

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    public function testGetCampaign()
    {
        $campaignID = "CMPT4EP";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Campaign/'.$campaignID.'/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/campaignGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->campaign->get($campaignID);
        self::assertNotNull($actual);
        $this->assertRequest($request);

    }

    public function testCampaignUpdate()
    {
        $campaignID = "CMPT4EP";
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Campaign/'.$campaignID.'/',
            [
                
                'reseller_id' => "",
                'description' => "",
                'sample1' => "sample 1 should be 20 minimum character",
                'sample2' => "",
                'message_flow' => "",
                'help_message' => "",
                'optout_message' => "",
                'optin_keywords' => "",
                'optout_keywords' => "",
                'optin_message' => "",
                'help_keywords' => "",
                
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/campaignUpdateResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->campaign->update($campaignID, "","","sample 1 should be 20 minimum character","","","","","","","","");

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }
   
    
    function testCampaignList()
    {
        $request = new PlivoRequest(
            'Get',
            'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Campaign/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/campaignListResponse.json');
        
        $this->mock(new PlivoResponse($request,202, $body));
        
        $actual = $this->client->campaign->list();
        
        $this->assertRequest($request);
        
        self::assertNotNull($actual);
    }

    function testCampaignGetNumber()
    {
        $campaignID = "CRIGC80";
        $number = "14845007032";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Campaign/'.$campaignID.'/Number'.'/'. $number.'/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/campaignGetNumberResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->campaign->getNumber($campaignID,$number);
        self::assertNotNull($actual);
        $this->assertRequest($request);

    }

    function testCampaignListNumber()
    {
        $campaignID = "CRIGC80";
        $request = new PlivoRequest(
            'Get',
            'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Campaign/'.$campaignID.'/Number'. '/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/campaignListNumberResponse.json');
        
        $this->mock(new PlivoResponse($request,202, $body));
        
        $actual = $this->client->campaign->listNumber($campaignID);
        
        $this->assertRequest($request);
        
        self::assertNotNull($actual);

    }

    public function testDeleteCampaign()
    {
        $campaignID = "CMPT4EP";
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Campaign/'.$campaignID.'/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/campaignDeleteResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->campaign->delete($campaignID);
        self::assertNotNull($actual);
        $this->assertRequest($request);

    }


}
