<?php

namespace Plivo\Resources\Brand;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class Media
 * @package Plivo\Resources\Media
 * @property string $content_type
 * @property string $file_name
 * @property string $media_id
 * @property int $size
 * @property string $upload_time
 * @property string $url
 */
class Brand extends Resource
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
            'brand' => $response['brand'],
            'api_id' => $response['api_id'],
        ];
        $this->uri = $uri;
    }
    public function __debugInfo() {
        return $this->properties;
    }
}