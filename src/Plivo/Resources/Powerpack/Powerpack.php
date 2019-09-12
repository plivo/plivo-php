<?php

namespace Plivo\Resources\Powerpack;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class Powerpack
 * @package Plivo\Resources\Powerpack
 * @property string $name
 * @property bool $sticky_sender
 * @property bool $local_connect
 * @property string $application_type
 * @property string $application_type
 * @property string $created_on
 * @property string $number_pool
 */
class Powerpack extends Resource
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
            'name' => $response['name'],
            'sticky_sender' => $response['sticky_sender'],
            'application_id' => $response['application_id'],
            'application_type' => $response['application_type'],
            'created_on' => $response['created_on'],
            'local_connect' => $response['local_connect'],
            'number_pool' => $response['number_pool'],
        ];

        $this->pathParams = [
            'authId' => $authId,
            'uuid' => $response['uuid']
        ];

        $this->id = $response['uuid'];
    }

}