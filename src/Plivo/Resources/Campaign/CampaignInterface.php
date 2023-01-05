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
     * @param $uuid
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

        return $response->getContent();
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
     * @param {string} message_flow
     * @param {string} help_message
     * @param {string} optout_message
     * @return campaignCreation response output
     */
    public function create($brand_id,$campaign_alias,$vertical,$usecase,array $sub_usecases,$description,$embedded_link,$embedded_phone,$age_gated,$direct_lending,$subscriber_optin,$subscriber_optout,$subscriber_help,$affiliate_marketing,$sample1,$sample2,$message_flow,$help_message,$optout_message,array $optionalArgs = [])
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
            'sample2' => $sample2,
            'message_flow' => $message_flow,
            'help_message' => $help_message,
            'optout_message' => $optout_message
        ];

        $response = $this->client->update(
            $this->uri .'10dlc/Campaign/',
            array_merge($mandaoryArgs, $optionalArgs)
        );

        return $response->getContent();   
    }


    /**
     * Update Campaign
     *
     * @param {string} campaignId
     * @param {string} description  
     * @param {string} reseller_id  
     * @param {string} sample1 
     * @param {string} sample2 
     * @param {string} message_flow
     * @param {string} help_message
     * @param {string} optin_keywords
     * @param {string} optin_message
     * @param {string} optout_keywords
     * @param {string} optout_message
     * @param {string} help_keywords
     * @return Campaign
     */
    public function update($campaignId,$description,$reseller_id,$sample1,$sample2,$message_flow,$help_message,$optin_keywords,$optin_message,$optout_keywords,$optout_message,$help_keywords,array $optionalArgs = [])
    {
        $mandaoryArgs = [
            'reseller_id' => $reseller_id,
            'description' => $description,
            'sample1' => $sample1,
            'sample2' => $sample2,
            'message_flow' => $message_flow,
            'help_message' => $help_message,
            'optout_message' => $optout_message,
            'optin_keywords' => $optin_keywords,
            'optout_keywords' => $optout_keywords,
            'optin_message' => $optin_message,
            'help_keywords' => $help_keywords,
        ];

        $response = $this->client->update(
            $this->uri . '10dlc/Campaign/'. $campaignId .'/',
            array_merge($mandaoryArgs, $optionalArgs)
        );

        $responseContents = $response->getContent();
        return $responseContents;
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

    /**
     * @param $campaign_id
     * @return Message
     * @throws PlivoValidationException
     */
    public function delete($campaignId)
    {
        if (ArrayOperations::checkNull([$campaignId])) {
            throw
            new PlivoValidationException(
                'campaign id is mandatory');
        }

        $response = $this->client->delete(
            $this->uri . '10dlc/Campaign/'. $campaignId .'/',
            []
        );
        return $response->getContent();   
    }
}