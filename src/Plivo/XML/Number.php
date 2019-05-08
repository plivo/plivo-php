<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Number
 * @package Plivo\XML
 */
class Number extends Element {
    protected $nestables = [];

    protected $valid_attributes = ['sendDigits', 'sendOnPreanswer', 'sendDigitsMode'];

    /**
     * Number constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoXMLException("No number set for ".$this->getName());
        }
    }
}