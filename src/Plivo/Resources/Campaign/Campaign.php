<?php

namespace Plivo\Resources\Campaign;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class Campaign
 * @package Plivo\Resources\Campaign
 
 */
class Campaign extends Resource
{
    /**
     * Campaign constructor.
     * @param BaseClient $client The Plivo API REST client
     * @param array $response
     * @param string $authId
     */
    public function __construct(
        BaseClient $client, $response, $authId, $uri)
    {
        parent::__construct($client);

        $this->properties = [
            'campaign_id' => $response['campaign_id'],
            'registration_status' => $response['registration_status'],
            'reseller_id' => $response['reseller_id'],
            'brand_id' => $response['brand_id'],
            'usecase' => $response['usecase'],
            'mno_metadata' => $response['mno_metadata'],
            'sub_usecase' => $response['sub_usecase'],
            'campaign_attributes' => $response['campaign_attributes'],
            'description' => $response['description'],
            'sample1' => $response['sample1'],
            'sample2' => $response['sample2'],
            'api_id' => $response['api_id'],
        ];
        $this->uri = $uri;
    }
    public function __debugInfo() {
        return $this->properties;
    }
}