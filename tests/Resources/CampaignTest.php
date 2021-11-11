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
                'description' => "sample description text",
                'embedded_link' => False,
                'embedded_phone' => False,
                'age_gated' => False,
                'direct_lending' => False,
                'subscriber_optin' => True,
                'subscriber_optout' => True,
                'subscriber_help' => True,
                'sample1' => "test 1",
                'sample2' => "test 2"
                        ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/campaignCreationResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->campaign->create("B8OD95Z", "campaign name sssample","INSURANCE", "MIXED", [
            "CUSTOMER_CARE",
            "2FA"
        ], "sample description text", False, False, False, False, True, True, True, "test 1", "test 2");

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

}