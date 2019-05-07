<?php

namespace Plivo\XML;


/**
 * Class PlivoXML
 * @package Plivo\XML
 */
class PlivoXML
{
    /**
     * @var Response
     */
    protected $response;

    /**
     * PlivoXML constructor.
     */
    function __construct()
    {
        $this->response = new Response();
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}
