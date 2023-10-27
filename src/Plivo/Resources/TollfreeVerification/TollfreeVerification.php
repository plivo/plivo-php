<?php

namespace Plivo\Resources\TollfreeVerification;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class EndUser
 * @package Plivo\Resources\TollfreeVerification
 * @property string $api_id
 * @property string $callback_method
 * @property string $callback_url
 * @property string $created_at
 * @property string $extra_data
 * @property string $additional_information
 * @property string $message_sample
 * @property string $number
 * @property string $optin_image_url
 * @property string $optin_type
 * @property string $profile_uuid
 * @property string $rejection_reason
 * @property string $status
 * @property string $updated_at
 * @property string $usecase
 * @property string $usecase_summary
 * @property string $uuid
 * @property string $volume
 */
class TollfreeVerification extends Resource
{
    function __construct(BaseClient $client, array $response, $authId)
    {
        parent::__construct($client);

        $this->properties = [
            'apiId' => $response['api_id'],
            'createdAt' => $response['created_at'],
            'number' => $response['number'],
            'updatedAt' => $response['updated_at'],
            'callbackMethod' => $response['callback_method']
            'callbackUrl' => $response['callback_url']
            'extraData' => $response['extra_data']
            'additionalInformation' => $response['additional_information']
            'messageSample' => $response['message_sample']
            'optinImageUrl' => $response['optin_image_url']
            'optinType' => $response['optin_type']
            'profileUuid' => $response['profile_uuid']
            'rejectionReason' => $response['rejection_reason']
            'status' => $response['status']
            'usecase' => $response['usecase']
            'usecase_summary' => $response['usecaseSummary']
            'uuid' => $response['uuid']
            'volume' => $response['volume']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'uuid' => $response['uuid']
        ];

        $this->id = $response['uuid'];
    }
}