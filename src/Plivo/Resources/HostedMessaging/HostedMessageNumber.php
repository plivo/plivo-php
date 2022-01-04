<?php

namespace Plivo\Resources\HostedMessaging;

use Plivo\BaseClient;
use Plivo\Resources\Resource;

class HostedMessageNumber extends Resource {

    function __construct(BaseClient $client, array $response, $authId) {

        parent::__construct($client);

        $this->properties = [
            'orderId' => $response['order_id'],
            'alias' => $response['alias'],
            'loaId' => $response['loa_id'],
            'application' => $response['application'],
            'number' => $response['number'],
            'createdAt' => $response['created_at'],
            'hostedStatus' => $response['hosted_status'],
            'failureReason' => $response['failure_reason'],
            'resourceURI' => $response['resource_uri']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'orderId' => $response['order_id']
        ];

        $this->id = $response['order_id'];

    }

}