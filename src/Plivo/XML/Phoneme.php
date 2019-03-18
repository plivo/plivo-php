<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Conference
 * @package Plivo\XML
 */
class Phoneme extends Element {

    protected $nestables = [];

    protected $valid_attributes = [
        'alphabet',
        'ph'
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
            throw new PlivoXMLException("No phoneme set for ".$this->getName());
        }
    }
}