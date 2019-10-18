<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class S
 * @package Plivo\XML
 */
class S extends Element {

    protected $nestables = [
        'break',
        'emphasis',
        'lang',
        'phoneme',
        'prosody',
        'say-as',
        'sub',
        'w'
    ];

    protected $valid_attributes = [];

    /**
     * S constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoXMLException("No s set for ".$this->getName());
        }
        $this->name = strtolower($this->name);
    }
}
