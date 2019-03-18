<?php

namespace Plivo\XML;

use Plivo\Exceptions\PlivoXMLException;


/**
 * Class Speak
 * @package Plivo\XML
 */
class Cont extends Element {
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
        'w',
        'cont'
    ];

    protected $valid_attributes = [];

    /**
     * Speak constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        if (!$body) {
            throw new PlivoXMLException("No text set for ".$this->getName());
        } else {
            $body = mb_encode_numericentity($body, [0x80, 0xffff, 0, 0xffff]);
        }
        parent::__construct($body, $attributes);
    }
}