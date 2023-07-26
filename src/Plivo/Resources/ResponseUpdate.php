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
     * @var
     */
    public $statusCode;

    /**
     * ResponseUpdate constructor.
     * @param $message
     * @param $newCNAM
     * @param $cnamUpdateStatus
     */
    public function __construct($apiId, $message, $newCNAM, $cnamUpdateStatus, $statusCode = 200)
    {
        $this->_message = $message;
        $this->apiId = $apiId;
        $this->statusCode = $statusCode;
        if ($newCNAM !== null){
            $this->newCNAM = $newCNAM;
        }
        if ($cnamUpdateStatus !== null){
            $this->cnamUpdateStatus = $cnamUpdateStatus;
        }
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

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}