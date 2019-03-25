<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class SayAs
 * @package Plivo\XML
 */
class SayAs extends Element {

    protected $nestables = [];

    protected $valid_attributes = [
        'interpret-as',
        'format'
    ];

    protected $valid_interpret_as_attribute_values = [
        'character',
        'spell-out',
        'cardinal',
        'number',
        'ordinal',
        'digits',
        'fraction',
        'unit',
        'date',
        'time',
        'address',
        'expletive',
        'telephone'
    ];

    protected $valid_format_attribute_values = [
        'mdy','dmy','ymd','md','dm','ym','my','d','m','y','yyyymmdd'
    ];

    /**
     * SayAs constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        if (!$body) {
            throw new PlivoXMLException("No say-as set for ".$this->getName());
        }

        foreach ($attributes as $key => $value) {
            if ($key ==='interpret-as' && !in_array($value, $this->valid_interpret_as_attribute_values)) {
                throw new PlivoXMLException(
                    "invalid attribute value ".$value." for ".$key." ".$this->name);
            }
            if ($key ==='format' && !in_array($value, $this->valid_format_attribute_values)) {
                throw new PlivoXMLException(
                    "invalid attribute value ".$value." for ".$key." ".$this->name);
            }
        }
        parent::__construct($body, $attributes);
        
    }
}