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

        // $this->properties = [
        //     'firstParty' => $response['first_party'],
        //     'secondParty' => $response['second_party'],
        //     'virtualNumber' => $response['virtual_number'],
        //     'status' => $response['status'],
        //     'initiateCallToFirstParty' => $response['initiate_call_to_first_party'],
        //     'sessionUuid' => $response['session_uuid'],
        //     'callbackUrl' => $response['callback_url'],
        //     'callbackMethod' => $response['callback_method'],
        //     'createdAt' => $response['created_time'],
        //     'updatedAt' => $response['modified_time'],
        //     'expiryAt' => $response['expiry_time'],
        //     'duration' => $response['duration'],
        //     'amount' => $response['amount'],
        //     'callTimeLimit' => $response['call_time_limit'],
        //     'ringTimeout' => $response['ring_timeout'],
        //     'firstPartyPlayUrl' => $response['first_party_play_url'],
        //     'secondPartyPlayUrl' => $response['second_party_play_url'],
        //     'record' => $response['record'],
        //     'recordFileFormat' => $response['record_file_format'],
        //     'recordingCallbackUrl' => $response['recording_callback_url'],
        //     'recordingCallbackMethod' => $response['recording_callback_method'],
        //     'interaction' => $response['interaction'],
        //     'totalCallAmount' => $response['total_call_amount'],
        //     'totalCallCount' => $response['total_call_count'],
        //     'totalCallBilledDuration' => $response['total_call_billed_duration'],
        //     'totalSessionAmount' => $response['total_session_amount'],
        //     'lastInteractionTime' => $response['last_interaction_time']
        // ];
        
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