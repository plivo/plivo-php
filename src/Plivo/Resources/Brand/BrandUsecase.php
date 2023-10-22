<?php

namespace Plivo\Resources\Brand;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class Brandusecase
 * @package Plivo\Resources\Brandusecase
 * @property string $content_type
 */
class BrandUsecase extends Resource
{
    /**
     * BrandUsecase constructor.
     * @param BaseClient $client The Plivo API REST client
     * @param string $use_cases
     * @param string $brand_id
     * @param string $api_id
     */
    public function __construct(
        BaseClient $client, $response, $authId, $uri)
    {
        parent::__construct($client);

        $this->properties = [
            'use_cases' => $response['use_cases'],
            'brand_id' => $response['brand_id'],
            'api_id' => $response['api_id'],
        ];
        $this->uri = $uri;
    }
    public function __debugInfo() {
        return $this->properties;
    }
}