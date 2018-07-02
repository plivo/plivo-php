<?php

namespace Plivo\Resources;

use Plivo\Exceptions\PlivoRestException;

/**
 * Class ResponseUpdate
 * @package Plivo\Resources
 */
class ResponseUpdate
{
    /**
     * @var
     */
    public $_message;

    /**
     * @var
     */
    public $apiId;

    /**
     * ResponseUpdate constructor.
     * @param $message
     */
    public function __construct($apiId, $message)
    {
        $this->_message = $message;
        $this->apiId = $apiId;
    }

    /**
     * @param $name
     * @return mixed
     * @throws PlivoRestException
     */
    function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        throw new PlivoRestException('Unknown Response property ' . $name);
    }
    /**
     * Get the API ID
     * @return mixed
     */
    public function getApiId()
    {
        return $this->apiId;
    }
    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->_message;
    }
}