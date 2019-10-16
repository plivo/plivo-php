<?php

namespace Plivo\XML;

use Plivo\Exceptions\PlivoXMLException;


/**
 * Class Cont
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
     * Cont constructor.
     * @param string $body
     * @throws PlivoXMLException
     */
    function __construct($body) {
        if (!$body) {
            throw new PlivoXMLException("No text set for ".$this->getName());
        }
        parent::__construct($body,null);
        $this->name = strtolower($this->name);
    }
}
