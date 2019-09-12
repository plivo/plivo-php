<?php

namespace Plivo\Resources\Powerpack;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class NumberPool
 * @package Plivo\Resources\Powerpack
 * @property bool $added_on
 * @property bool $country_iso2
 * @property string $shortcode
 * @property string $number_pool_uuid
 */
class Shortcode extends Resource
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
            'added_on' => $response['added_on'],
            'country_iso2' => $response['country_iso2'],
            'shortcode' => $response['number'],
            'number_pool_uuid' => $response['number_pool_uuid']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'number_pool_uuid' => $response['number_pool_uuid']
        ];

        $this->id = $response['number_pool_uuid'];
    }

}