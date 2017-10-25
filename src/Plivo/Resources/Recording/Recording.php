<?php

namespace Plivo\Resources\Recording;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class Recording
 * @package Plivo\Resources\Recording
 * @property string $addTime
 * @property string $callUuid
 * @property string $conferenceName
 * @property string $recordingStartMs
 * @property string $recordingEndMs
 * @property string $recordingDurationMs
 * @property string $recordingFormat
 * @property string $recordingType
 * @property string $recordingUrl
 * @property string $recordingId
 * @property string $resourceUri
 */
class Recording extends Resource
{
    /**
     * Recording constructor.
     * @param BaseClient $client
     * @param array $response
     * @param $authId
     */
    function __construct(BaseClient $client, array $response, $authId)
    {
        parent::__construct($client);

        $this->properties = [
            'addTime' => $response['add_time'],
            'callUuid' => $response['call_uuid'],
            'conferenceName' => $response['conference_name'],
            'recordingStartMs' => $response['recording_start_ms'],
            'recordingEndMs' => $response['recording_end_ms'],
            'recordingDurationMs' => $response['recording_duration_ms'],
            'recordingFormat' => $response['recording_format'],
            'recordingType' => $response['recording_type'],
            'recordingUrl' => $response['recording_url'],
            'recordingId' => $response['recording_id'],
            'resourceUri' => $response['resource_uri']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'recordingId' => $response['recording_id']
        ];

        $this->id = $response['recording_id'];
    }
}