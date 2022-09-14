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
            'api_id' => $response['api_id'],
        ];
        $this->uri = $uri;
    }
    public function __debugInfo() {
        return $this->properties;
    }
}