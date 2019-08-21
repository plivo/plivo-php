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
        'x-sampa'
    ];

    protected $valid_ph_attribute_values = [
        'cmn-CN','da-DK','nl-NL','en-AU','en-GB',
        'en-IN','en-US','en-GB-WLS','fr-FR',
        'fr-CA','de-DE','hi-IN','is-IS','it-IT',
        'ja-JP','ko-KR','nb-NO','pl-PL','pt-BR',
        'pt-PT','ro-RO','ru-RU','es-ES','es-MX',
        'es-US','sv-SE','tr-TR','cy-GB'
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
                // if ($key ==='ph' && !in_array($value, $this->valid_ph_attribute_values)) {
                //     throw new PlivoXMLException(
                //         "invalid attribute value ".$value." for ".$key." ".$this->name);
                // }
            }
        }
        parent::__construct($body, $attributes);
    }
}