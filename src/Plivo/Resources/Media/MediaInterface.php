<?php

namespace Plivo\Resources\Media;

use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResponseUpdate;
use Plivo\Util\ArrayOperations;
use Plivo\Exceptions\PlivoValidationException;

/**
 * Class MediaInterface
 * @package Plivo\Resources
 */
class MediaInterface extends ResourceInterface
{
    /**
     * MediaInterface constructor.
     * @param BaseClient $plivoClient The Plivo api REST client
     * @param string $authId The authentication token
     */
    public function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);

        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/Media/";
    }

    /**
     * You can call this method to retrieve all your media
     * @return Array
     */
    public function list($optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );

        return json_encode($response->getContent(), JSON_FORCE_OBJECT);
    }

    /**
     * You can call this method to fetch a particular media
     * @return Array
     */
    public function get($mediaId)
    {
        $uri = $this->uri . $mediaId . '/';
        $response = $this->client->fetch(
            $uri,
            []
        );

        return json_encode($response->getContent(), JSON_FORCE_OBJECT);
    }

    /**
     * You can call this method to add an media
     * @return Array
     */
    public function upload($optionalArgs = []) 
    {
        $response = $this->client->update(
            $this->uri,
            $optionalArgs
        );

        return json_encode($response->getContent(), JSON_FORCE_OBJECT);
    }

    
}