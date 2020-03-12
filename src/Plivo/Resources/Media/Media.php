<?php

namespace Plivo\Resources\Media;


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
class Media extends Resource
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
            'content_type' => $response['content_type'],
            'file_name' => $response['file_name'],
            'media_id' => $response['media_id'],
            'size' => $response['size'],
            'upload_time' => $response['upload_time'],
            'url' => $response['url'],
        ];

        $this->pathParams = [
            'authId' => $authId,
            'media_id' => $response['media_id']
        ];
        $this->id = $response['media_id'];
        $this->uri = $uri;
    }
}
