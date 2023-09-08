<?php

namespace Plivo\Resources\MaskingSession;

use Plivo\BaseClient;
use Plivo\Resources\Resource;


class MaskingSession extends Resource
{
    /**
     * MaskingSession constructor.
     * @param BaseClient $client
     * @param $response
     * @param $authId
     */
    function __construct(
        BaseClient $client, $response, $authId)
    {
        parent::__construct($client); 
        $this->properties = [
            'api_id' => $response['api_id'],
            'response' => $response['response']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'sessionUuid' => $response['response']['session_uuid']
        ];

        $this->id = $response['response']['session_uuid'];

    }
}