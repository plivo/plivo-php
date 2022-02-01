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

    /**
     * ResponseDelete constructor.
     * @param null $message
     */
    function __construct($statusCode = 204, $message = null)
    {
        $this->message = $message;
        $this->statusCode = $statusCode;
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