<?php

namespace Plivo\Resources\Token;

use Plivo\BaseClient;
use Plivo\Resources\Resource;


/**
 * Class Token
 * @package Plivo\Resources\Token
 * @property string $iss The Auth_id
 * @property string $sub The Subject
 * @property integer $nbf The creation time
 * @property integer $exp The expiration time
 * @property string $incoming_allow The incoming_allow
 * @property boolean $outgoing_allow The outgoing_allow flag
 * @property string $app The app id
 */
class Token extends Resource
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
            'iss' => $response['iss'],
            'sub' => $response['sub'],
            'nbf' => $response['nbf'],
            'exp' => $response['exp'],
            'incoming_allow' => $response['incoming_allow'],
            'outgoing_allow' => $response['outgoing_allow'],
            'app' => $response['app']
        ];
    }
}