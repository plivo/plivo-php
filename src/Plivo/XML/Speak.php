<?php

namespace Plivo\XML;

use Plivo\Exceptions\PlivoXMLException;


/**
 * Class Speak
 * @package Plivo\XML
 */
class Speak extends Element {
    protected $nestables = [];

    protected $valid_attributes = ['voice', 'language', 'loop'];

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
