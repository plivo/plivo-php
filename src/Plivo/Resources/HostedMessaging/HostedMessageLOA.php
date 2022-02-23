<?php

namespace Plivo\Resources\HostedMessaging;

use Plivo\BaseClient;
use Plivo\Resources\Resource;

class HostedMessageLOA extends Resource {

    function __construct(BaseClient $client, array $response, $authId)
    {
        parent::__construct($client);

        $this->properties = [
            'file' => $response['file'],
            'alias' => $response['alias'],
            'loaId' => $response['loa_id'],
            'linkedNumbers' => $response['linked_numbers'],
            'resourceUri' => $response['resource_uri'],
            'createdAt' => $response['created_at'],
        ];

        $this->pathParams = [
            'authId' => $authId,
            'loaId' => $response['loa_id']
        ];

        $this->id = $response['loa_id'];
    }

}