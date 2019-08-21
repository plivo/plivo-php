<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class W
 * @package Plivo\XML
 */
class W extends Element {

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
        'w'
    ];

    protected $valid_attributes = [
        'role'
    ];

    protected $valid_role_attribute_values = [
        'amazon:VB','amazon:VBD','amazon:SENSE_1'
    ];

    /**
     * W constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        if (!$body) {
            throw new PlivoXMLException("No w set for ".$this->getName());
        }

        if(!empty($attributes)){
            foreach ($attributes as $key => $value) {
                if ($key ==='role' && !in_array($value, $this->valid_role_attribute_values)) {
                    throw new PlivoXMLException(
                        "invalid attribute value ".$value." for ".$key." ".$this->name);
                }
            }
        }

        parent::__construct($body, $attributes);
        
    }
}