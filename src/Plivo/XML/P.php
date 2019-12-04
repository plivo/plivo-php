<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class P
 * @package Plivo\XML
 */
class P extends Element {

    protected $nestables = [
        'break',
        'emphasis',
        'lang',
        'phoneme',
        'prosody',
        's',
        'say-as',
        'sub',
        'w'
    ];

    protected $valid_attributes = [];

    /**
     * P constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body) {
        parent::__construct($body, null);
        if (!$body) {
            throw new PlivoXMLException("No p set for ".$this->getName());
        }
        $this->name = strtolower($this->name);
    }
}
