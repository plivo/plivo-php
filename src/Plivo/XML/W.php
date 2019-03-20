<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class W
 * @package Plivo\XML
 */
class W extends Element {

    protected $nestables = [
        'break',
        'emphasis',
        'lang',
        'p',
        'phoneme',
        'prosody',
        's',
        'say-as',
        'sub',
        'w'
    ];

    protected $valid_attributes = [
        'role'
    ];

    /**
     * W constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoXMLException("No w set for ".$this->getName());
        }
    }
}