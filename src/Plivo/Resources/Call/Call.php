<?php

namespace Plivo\Resources\Call;

use Plivo\BaseClient;
use Plivo\Resources\Resource;


/**
 * Class Call
 * @package Plivo\Resources\Call
 * @property string $answerTime The time at which call was answered
 * @property string $billDuration The bill duration
 * @property string $billedDuration The duration for which billed
 * @property string $callDirection The call direction
 * @property string $callDuration The call duration
 * @property string $callUuid The call UUID
 * @property string $endTime The time at which call ended
 * @property string $from The caller
 * @property string $initiationTime The time of request initiation
 * @property string $parentCallUuid The call UUID of the parent call
 * @property string $resourceUri The resource URI
 * @property string $to The callee
 * @property string $totalAmount The total amount
 * @property string $totalRate The total rate
 */
class Call extends Resource
{
    /**
     * Call constructor.
     * @param BaseClient $client
     * @param $response
     * @param $authId
     */
    function __construct(
        BaseClient $client, $response, $authId)
    {
        parent::__construct($client);

        $this->properties = [
            'answerTime' => $response['answer_time'],
            'billDuration' => $response['bill_duration'],
            'billedDuration' => $response['billed_duration'],
            'callDirection' => $response['call_direction'],
            'callDuration' => $response['call_duration'],
            'callUuid' => $response['call_uuid'],
            'endTime' => $response['end_time'],
            'from' => $response['from_number'],
            'initiationTime' => $response['initiation_time'],
            'parentCallUuid' => $response['parent_call_uuid'],
            'resourceUri' => $response['resource_uri'],
            'to' => $response['to_number'],
            'totalAmount' => $response['total_amount'],
            'totalRate' => $response['total_rate']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'callUuid' => $response['call_uuid']
        ];

        $this->id = $response['call_uuid'];

    }
}