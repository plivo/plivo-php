<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Emphasis
 * @package Plivo\XML
 */
class Emphasis extends Element {

    protected $nestables = [
        'break',
        'emphasis',
        'lang',
        'phoneme',
        'prosody',
        'say-as',
        'sub',
        'w'
    ];

    protected $valid_attributes = [
        'level'
    ];

    protected $valid_level_attribute_values = [
        'strong',
        'moderate',
        'reduced'
    ];

    /**
     * Emphasis constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        if (!$body) {
            throw new PlivoXMLException("No emphasis set for ".$this->getName());
        }
        if(!empty($attributes)){
            foreach ($attributes as $key => $value) {
                if ($key ==='level' && !in_array($value, $this->valid_level_attribute_values)) {
                    throw new PlivoXMLException(
                        "invalid attribute value ".$value." for ".$key." ".$this->name);
                }
            }
        }
        
        parent::__construct($body, $attributes);
        $this->name = strtolower($this->name);
    }
}
