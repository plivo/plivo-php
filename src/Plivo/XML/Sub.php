<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Sub
 * @package Plivo\XML
 */
class Sub extends Element {

    protected $nestables = [];

    protected $valid_attributes = [
        'alias'
    ];

    /**
     * Sub constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        if (!$body) {
            throw new PlivoXMLException("No sub set for ".$this->getName());
        }
        parent::__construct($body, $attributes);
        $this->name = strtolower($this->name);
    }
}
