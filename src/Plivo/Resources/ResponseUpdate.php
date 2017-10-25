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
    private $_message;

    /**
     * ResponseUpdate constructor.
     * @param $message
     */
    public function __construct($message)
    {
        $this->_message = $message;
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
     * @return mixed
     */
    public function getMessage()
    {
        return $this->_message;
    }



}