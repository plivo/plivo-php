<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Phoneme
 * @package Plivo\XML
 */
class Phoneme extends Element {

    protected $nestables = [];

    protected $valid_attributes = [
        'alphabet',
        'ph'
    ];

    protected $valid_alphabet_attribute_values = [
        'ipa',
        'x-sampa',
        'x-amazon-pinyin'
    ];

    /**
     * Phoneme constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {

        if (!$body) {
            throw new PlivoXMLException("No phoneme set for ".$this->getName());
        }
        if(!empty($attributes)){
            foreach ($attributes as $key => $value) {
                if ($key ==='alphabet' && !in_array($value, $this->valid_alphabet_attribute_values)) {
                    throw new PlivoXMLException(
                        "invalid attribute value ".$value." for ".$key." ".$this->name);
                }
            }
        }
        parent::__construct($body, $attributes);
        $this->name = strtolower($this->name);
    }
}
