<?php

namespace Plivo\Resources\Profile;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class Profile
 * @package Plivo\Resources\Profile
 * @property string $profile_uuid
 */
class Profile extends Resource
{
    /**
     * Media constructor.
     * @param BaseClient $client The Plivo API REST client
     * @param array $response
     * @param string $authId
     */
    public function __construct(
        BaseClient $client, $response, $authId, $uri)
    {
        parent::__construct($client);

        $this->properties = [
            'profile_uuid' => $response['profile_uuid'],
            'api_id' => $response['api_id'],
        ];
        $this->uri = $uri;
    }
    public function __debugInfo() {
        return $this->properties;
    }
}