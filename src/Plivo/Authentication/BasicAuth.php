<?php

namespace Plivo\Authentication;


/**
 * Class BasicAuth
 * @package Plivo\Authentication
 */
class BasicAuth
{
    /**
     * @var string
     */
    protected $authId;
    /**
     * @var string
     */
    protected $authToken;

    /**
     * BasicAuth constructor.
     * @param string|null $authId
     * @param string|null $authToken
     */
    public function __construct($authId = null, $authToken = null)
    {
        // if null try from the environment
        $this->authId = $authId?:getenv('PLIVO_AUTH_ID');
        $this->authToken = $authToken?:getenv('PLIVO_AUTH_TOKEN');
    }

    /**
     * Returns the authentication id
     * @return string
     */
    public function getAuthId()
    {
        return $this->authId;
    }

    /**
     * Returns the authentication token
     * @return string
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }
}