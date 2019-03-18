<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Conference
 * @package Plivo\XML
 */
class Break_ extends Element {

    protected $nestables = [];

    protected $valid_attributes = [
        'strength',
        'time'
    ];

    /**
     * BreakTag constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($attributes = []) {
        parent::__construct(null, $attributes);
        // if (!$body) {
        //     throw new PlivoXMLException("No break set for ".$this->getName());
        // }
    }
}