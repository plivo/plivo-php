<?php

namespace Plivo\Resources\Endpoint;


use Plivo\Resources\ResponseUpdate;

/**
 * Class EndpointCreateReponse
 * @package Plivo\Resources\Endpoint
 */
class EndpointCreateReponse extends ResponseUpdate
{
    /**
     * @var string The username of the endpoint
     */
    protected $username;
    /**
     * @var string The friendly name of the endpoint
     */
    protected $alias;
    /**
     * @var string The ID of the endpoint
     */
    protected $endpointId;

    /**
     * EndpointCreateReponse constructor.
     * @param string $message
     * @param string $username
     * @param string $alias
     * @param string $endpointId
     */
    public function __construct($username, $alias, $message, $endpointId, $apiID)
    {
        parent::__construct($apiID, $message);
        $this->username = $username;
        $this->alias = $alias;
        $this->endpointId = $endpointId;
    }

    /**
     * Get the username of the endpoint
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the alias of the endpoint
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Get the ID of the endpoint
     * @return string
     */
    public function getEndpointId()
    {
        return $this->endpointId;
    }


}