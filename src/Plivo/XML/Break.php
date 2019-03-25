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
    protected $valid_strength_attribute_values = [
        'none',
        'x-weak',
        'weak',
        'medium',
        'strong',
        'x-strong'
    ];

    /**
     * Break_ constructor.
     * @param array $attributes
     */
    function __construct($attributes = []) {

        foreach ($attributes as $key => $value) {
            if ($key ==='strength' && !in_array($value, $this->valid_strength_attribute_values)) {
                throw new PlivoXMLException(
                    "invalid attribute value ".$value." for ".$key." ".$this->name);
            }
            // if ($key ==='time' && !in_array($value, $this->valid_time_attribute_values)) {
            //     throw new PlivoXMLException(
            //         "invalid attribute value ".$value." for ".$key." ".$this->name);
            // }
        }
        parent::__construct(null, $attributes);
    }
}