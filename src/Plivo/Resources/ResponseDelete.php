<?php

namespace Plivo\Resources;


use Plivo\Exceptions\PlivoRestException;

/**
 * Class ResponseDelete
 * @package Plivo\Resources
 */
class ResponseDelete
{
    /**
     * @var null
     */
    protected $message;
    protected $statusCode;
    protected $apiId;

    /**
     * ResponseDelete constructor.
     * @param null $message
     */
    function __construct($statusCode = null, $message = null, $apiId = null)
    {
        $this->message = $message;
        $this->statusCode = $statusCode;
        $this->apiId = $apiId;
    }

    /**
     * @param $name
     * @return mixed
     * @throws PlivoRestException
     */
    function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new PlivoRestException('Delete response does not contain '.$name.' property');
    }
}