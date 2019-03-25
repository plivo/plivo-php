<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Sub
 * @package Plivo\XML
 */
class Sub extends Element {

    protected $nestables = [];

    protected $valid_attributes = [
        'alias'
    ];

    /**
     * Sub constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        if (!$body) {
            throw new PlivoXMLException("No sub set for ".$this->getName());
        }
        // if(!empty($attributes)){
        //     foreach ($attributes as $key => $value) {
        //         if ($key ==='interpret-as' && !in_array($value, $this->valid_interpret_as_attribute_values)) {
        //             throw new PlivoXMLException(
        //                 "invalid attribute value ".$value." for ".$key." ".$this->name);
        //         }
        //     }
        // }
        parent::__construct($body, $attributes);
        
    }
}