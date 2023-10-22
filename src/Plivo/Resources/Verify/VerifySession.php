<?php

namespace Plivo\Resources\Verify;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class VerifySession
 * @package Plivo\Resources\Verify
 * @property string $apiId
 * @property string $sessionUuid
 * @property string $appUuid
 * @property string $alias
 * @property string $recipient
 * @property string $channel
 * @property string $status
 * @property int $count
 * @property ?string $requestor_ip
 * @property ?string $destination_country_iso2
 * @property ?string $destination_network
 * @property ?string $attempt_details
 * @property ?string $charges
 * @property string $created_at
 * @property string $updated_at
 */
class VerifySession extends Resource
{
    /**
     * VerifySession constructor.
     * @param BaseClient $client The Plivo API REST client
     * @param array $response
     * @param string $authId
     */
    public function __construct(
        BaseClient $client, $response, $authId, $uri)
    {
        parent::__construct($client);

        $this->properties = [
            'sessionUuid' => $response['session_uuid'],
            'appUuid' => $response['app_uuid'],
            'alias' => $response['alias'],
            'recipient' => $response['recipient'],
            'channel' => $response['channel'],
            'status' => $response['status'],
            'count' => $response['count'],
            'createdAt' => $response['created_at'],
            'updatedAt' => $response['updated_at'],
        ];

        // handled empty string and null case
        if (!empty($response['api_id'])) {
            $this->properties['apiId'] = $response['api_id'];
        }

        if (!empty($response['requestor_ip'])) {
            $this->properties['requesterIP'] = $response['requestor_ip'];
        }

        if (!empty($response['destination_country_iso2'])) {
            $this->properties['destinationCountryIso2'] = $response['destination_country_iso2'];
        }
        if (!empty($response['destination_network'])) {
            $this->properties['destinationNetwork'] = $response['destination_network'];
        }
        if (!empty($response['attempt_details'])) {
            $this->properties['attemptDetails'] = $response['attempt_details'];
        }
        if (!empty($response['charges'])) {
            $this->properties['charges'] = $response['charges'];
        }

       
        $this->pathParams = [
            'authId' => $authId,
            'sessionUuid' => $response['session_uuid']
        ];

        $this->id = $response['session_uuid'];
        $this->uri = $uri;
    }
    public function __debugInfo() {
        return $this->properties;
    }
}