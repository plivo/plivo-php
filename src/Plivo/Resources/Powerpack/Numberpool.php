<?php

namespace Plivo\Resources\Powerpack;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class NumberPool
 * @package Plivo\Resources\Powerpack
 * @property string $account_phone_number_resource
 * @property bool $added_on
 * @property bool $country_iso2
 * @property string $number
 * @property string $number_pool_uuid
 * @property string $type
 */
class NumberPool extends Resource
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
            'account_phone_number_resource' => $response['account_phone_number_resource'],
            'added_on' => $response['added_on'],
            'country_iso2' => $response['country_iso2'],
            'number' => $response['number'],
            'number_pool_uuid' => $response['number_pool_uuid'],
            'type' => $response['type']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'number_pool_uuid' => $response['number_pool_uuid']
        ];

        $this->id = $response['number_pool_uuid'];
    }

}