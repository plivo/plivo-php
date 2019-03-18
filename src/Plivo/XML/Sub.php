<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Conference
 * @package Plivo\XML
 */
class Sub extends Element {

    protected $nestables = [];

    protected $valid_attributes = [
        'alias'
    ];

    /**
     * BreakTag constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoXMLException("No sub set for ".$this->getName());
        }
    }
}