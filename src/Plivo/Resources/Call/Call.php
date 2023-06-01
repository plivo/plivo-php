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
 * @property string $hangupCauseCode Hangup Cause Code
 * @property string $hangupCauseName Hangup Cause Name
 * @property string $hangupSource Hangup Source
 * @property string $stirVerification Stir Verification
 * @property string $voiceNetworkGroup Voice Network Group
 * @property string $sourceIp Source Ip
 * @property string $cnamLookup Cnam Lookup
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
            'callState' => $response['call_state'],
            'callUuid' => $response['call_uuid'],
            'conferenceUuid' => $response['conference_uuid'],
            'endTime' => $response['end_time'],
            'from' => $response['from_number'],
            'initiationTime' => $response['initiation_time'],
            'parentCallUuid' => $response['parent_call_uuid'],
            'resourceUri' => $response['resource_uri'],
            'to' => $response['to_number'],
            'totalAmount' => $response['total_amount'],
            'totalRate' => $response['total_rate'],
            'hangupCauseCode' => $response['hangup_cause_code'],
            'hangupCauseName' => $response['hangup_cause_name'],
            'hangupSource' => $response['hangup_source'],
            'stirVerification' => $response['stir_verification'],
            'voiceNetworkGroup' => $response['voice_network_group'],
            'sourceIp' => $response['source_ip'],
            'cnamLookup' => $response['cnam_lookup']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'callUuid' => $response['call_uuid']
        ];

        $this->id = $response['call_uuid'];

    }
}