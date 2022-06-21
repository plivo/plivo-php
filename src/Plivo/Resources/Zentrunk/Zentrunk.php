<?php

namespace Plivo\Resources\Zentrunk;

use Plivo\BaseClient;
use Plivo\Resources\Resource;


/**
 * Class ZentrunkCall
 * @package Plivo\Resources\Zentrunk
 * @property string $answerTime The time at which call was answered
 * @property string $billDuration The bill duration
 * @property string $callDirection The call direction
 * @property string $duration The call duration
 * @property string $callUuid The call UUID
 * @property string $endTime The time at which call ended
 * @property string $from The caller
 * @property string $initiationTime The time of request initiation
 * @property string $to The callee
 * @property string $totalAmount The total amount
 * @property string $rate The total rate
 * @property string $hangupInitiator Hangup Initiator
 * @property string $hangupCause Hangup Cause 
 * @property string $hangupCode Hangup Code
 * @property string $stirVerification Stir Verification
 * @property string $trunkDomain
 * @property string $region
 * @property string $fromCountry
 * @property string $toCountry
 * @property string $transportProtocol
 * @property string $srtp
 * @property string $secureTrunking
 * @property string $secureTrunkingRate
 */
class Zentrunk extends Resource
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
            'callDirection' => $response['call_direction'],
            'duration' => $response['duration'],
            'callUuid' => $response['call_uuid'],
            'endTime' => $response['end_time'],
            'from' => $response['from_number'],
            'initiationTime' => $response['initiation_time'],
            'to' => $response['to_number'],
            'totalAmount' => $response['total_amount'],
            'rate' => $response['rate'],
            'hangupInitiator' => $response['hangup_initiator'],
            'hangupCause' => $response['hangup_cause'],
            'hangupCode' => $response['hangup_code'],
            'stirVerification' => $response['stir_verification'],
            'trunkDomain' => $response['trunk_domain'],
            'region' => $response['region'],
            'fromCountry' => $response['from_country'],
            'toCountry' => $response['to_country'],
            'transportProtocol' => $response['transport_protocol'],
            'srtp' => $response['srtp'],
            'secureTrunking' => $response['secure_trunking'],
            'secureTrunkingRate' => $response['secure_trunking_rate']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'callUuid' => $response['call_uuid']
        ];

        $this->id = $response['call_uuid'];

    }
}