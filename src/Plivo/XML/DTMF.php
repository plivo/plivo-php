<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class DTMF
 * @package Plivo\XML
 */
class DTMF extends Element {
    protected $nestables = [];

    protected $valid_attributes = ['async'];

    /**
     * DTMF constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoXMLException("No digits set for ".$this->getName());
        }
    }
}