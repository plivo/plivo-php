<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Conference
 * @package Plivo\XML
 */
class Lang extends Element {

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
        'xmllang'
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
            throw new PlivoXMLException("No emphasis set for ".$this->getName());
        }
    }
}