<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Break
 * @package Plivo\XML
 */
class Break_ extends Element {

    protected $nestables = [];

    protected $valid_attributes = [
        'strength',
        'time'
    ];

    /**
     * Break_ constructor.
     * @param array $attributes
     */
    function __construct($attributes = []) {
        parent::__construct(null, $attributes);
    }
}