<?php

namespace Plivo\Resources\Message;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class Message
 * @package Plivo\Resources\Message
 * @property string $from
 * @property string $to
 * @property string $messageDirection
 * @property string $messageState
 * @property string $messageTime
 * @property string $messageType
 * @property string $messageUuid
 * @property string $resourceUri
 * @property string $totalAmount
 * @property string $totalRate
 * @property string $units
 */
class Message extends Resource
{
    /**
     * Message constructor.
     * @param BaseClient $client The Plivo API REST client
     * @param array $response
     * @param string $authId
     */
    public function __construct(
        BaseClient $client, $response, $authId)
    {
        parent::__construct($client);

        $this->properties = [
            'from' => $response['from_number'],
            'to' => $response['to_number'],
            'messageDirection' => $response['message_direction'],
            'messageState' => $response['message_state'],
            'messageTime' => $response['message_time'],
            'messageType' => $response['message_type'],
            'messageUuid' => $response['message_uuid'],
            'resourceUri' => $response['resource_uri'],
            'totalAmount' => $response['total_amount'],
            'totalRate' => $response['total_rate'],
            'units' => $response['units']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'messageUuid' => $response['message_uuid']
        ];

        $this->id = $response['message_uuid'];
    }

}