<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class SayAs
 * @package Plivo\XML
 */
class SayAs extends Element {

    protected $nestables = [];

    protected $valid_attributes = [
        'interpret-as',
        'format'
    ];

    /**
     * SayAs constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoXMLException("No say-as set for ".$this->getName());
        }
    }
}