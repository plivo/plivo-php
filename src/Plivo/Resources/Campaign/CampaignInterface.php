<?php

namespace Plivo\Resources\Campaign;



use Plivo\Exceptions\PlivoValidationException;
use Plivo\Exceptions\PlivoRestException;
use Plivo\Exceptions\PlivoResponseException;
use Plivo\Util\ArrayOperations;
use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;
use Plivo\Exceptions\PlivoNotFoundException;
use Plivo\Resources\ResourceList;

/**
 * Class CampaignInterface
 * @package Plivo\Resources\Campaign
 */
class CampaignInterface extends ResourceInterface
{
    /**
     * CampaignInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    /**
     * @var null
     */
    public function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/";
    }

    /**
     * @param $campaignId
     * @return Campaign
     * @throws PlivoValidationException
     */
    public function get($campaignId)
    {
        if (ArrayOperations::checkNull([$campaignId])) {
            throw
            new PlivoValidationException(
                'campaign id is mandatory');
        }

        $response = $this->client->fetch(
            $this->uri . '10dlc/Campaign/'. $campaignId .'/',
            []
        );
        $responseContents = $response->getContent();
        return new Campaign(
            $this->client, $responseContents,
            $this->pathParams['authId'], $this->uri);
    }

  

     /**
     * Return a list of campaigns
     * @param array $optionalArgs
     * @return ResourceList output
     */
    public function list( $optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri . '10dlc/Campaign/',
            $optionalArgs
        );

        $campaigns = [];

        foreach ($response->getContent()['campaigns'] as $campaign) {
            $newCampaign = new Campaign(
                $this->client,
                $campaign,
                $this->pathParams['authId'],
                $this->uri);

            array_push($campaigns, $newCampaign);
        }

        return new CampaignList(
            $this->client,
            $response->getContent()['meta'],
            $campaigns);
    }
    

    /**
     * Create a new Campaign
     *
     * @param {string} brand_id 
     * @param {string} campaign_alias 
     * @param {string} vertical 
     * @param {string} usecase 
     * @param {list} sub_usecases 
     * @param {string} description  
     * @param {boolean} embedded_link 
     * @param {boolean} embedded_phone 
     * @param {boolean} age_gated 
     * @param {boolean} direct_lending 
     * @param {boolean} subscriber_optin 
     * @param {boolean} subscriber_optout 
     * @param {boolean} subscriber_help 
     * @param {boolean} affiliate_marketing
     * @param {string} sample1 
     * @param {string} sample2 
     * @return campaignCreation response output
     */
    public function create($brand_id,$campaign_alias,$vertical,$usecase,array $sub_usecases,$description,$embedded_link,$embedded_phone,$age_gated,$direct_lending,$subscriber_optin,$subscriber_optout,$subscriber_help,$affiliate_marketing,$sample1,$sample2, array $optionalArgs = [])
    {
        $mandaoryArgs = [
            'brand_id' => $brand_id,
            'campaign_alias' => $campaign_alias,
            'vertical' => $vertical,
            'usecase' => $usecase,
            'sub_usecases' => $sub_usecases,
            'description' => $description,
            'embedded_link' => $embedded_link,
            'embedded_phone' => $embedded_phone,
            'age_gated' => $age_gated,
            'direct_lending' => $direct_lending,
            'subscriber_optin' => $subscriber_optin,
            'subscriber_optout' => $subscriber_optout,
            'subscriber_help' => $subscriber_help,
            'affiliate_marketing' => $affiliate_marketing,
            'sample1' => $sample1,
            'sample2' => $sample2
        ];

        $response = $this->client->update(
            $this->uri .'10dlc/Campaign/',
            array_merge($mandaoryArgs, $optionalArgs)
        );

        return $response->getContent();   
    }

    public function getNumber($campaignId, $number)
    {
        $response = $this->client->fetch(
            $this->uri . '10dlc/Campaign/'. $campaignId .'/'.'Number/'.$number.'/',
            []
        );
        return $response->getContent();
    }

    public function listNumber($campaignId)
    {
        $response = $this->client->fetch(
            $this->uri . '10dlc/Campaign/'. $campaignId .'/'.'Number/',
            []
        );
        return $response->getContent();
    }
    // $numbers in array of number {"numbers": ["123"]}
    public function linkNumber($campaignId, $numbers, array $optionalArgs = [])
    {
        $optionalArgs['numbers'] = $numbers;
        $response = $this->client->update(
            $this->uri . '10dlc/Campaign/'. $campaignId .'/'.'Number/',
            $optionalArgs
        );
        return $response->getContent();
    }

    public function deleteNumber($campaignId, $number, $optionalArgs = [])
    {
        $response = $this->client->delete(
            $this->uri . '10dlc/Campaign/'. $campaignId .'/'.'Number/'.$number.'/',
            $optionalArgs
        );
        return $response->getContent();
    }
}