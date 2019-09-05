<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Prosody
 * @package Plivo\XML
 */
class Prosody extends Element {

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
        'volume',
        'rate',
        'pitch'
    ];

    protected $valid_volume_attribute_values = [
        'default',
        'silent',
        'x-soft',
        'soft',
        'medium',
        'loud',
        'x-loud'
    ];

    protected $valid_rate_attribute_values = [
        'x-slow', 'slow', 'medium', 'fast','x-fast'
    ];

    protected $valid_pitch_attribute_values = [
        'default','x-low', 'low', 'medium', 'high', 'x-high'
    ];

    /**
     * Prosody constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        if (!$body) {
            throw new PlivoXMLException("No text set for ".$this->getName());
        }
        if(!empty($attributes)){
            foreach ($attributes as $key => $value) {
                if ($key ==='volume' && !in_array($value, $this->valid_volume_attribute_values)) {
                    if (strpos($value, 'dB') !== false) {
                    } else {
                        throw new PlivoXMLException(
                            "invalid attribute value ".$value." for ".$key." ".$this->name);
                    }
                }
                if ($key ==='rate' && !in_array($value, $this->valid_rate_attribute_values)) {
                    if (strpos($value, '%') !== false) {
                        $per = explode('%',$value);
                        if($per[0]<0){
                            throw new PlivoXMLException(
                                "invalid attribute value ".$value." for ".$key." ".$this->name);
                        }
                    } else {
                        throw new PlivoXMLException(
                            "invalid attribute value ".$value." for ".$key." ".$this->name);
                    }
                }

                if ($key ==='pitch' && !in_array($value, $this->valid_pitch_attribute_values)) {
                    if (strpos($value, '%') !== false) {
                    } else {
                        throw new PlivoXMLException(
                            "invalid attribute value ".$value." for ".$key." ".$this->name);
                    }
                }
            }
        }

        parent::__construct($body, $attributes);
        $this->name = strtolower($this->name);
    }
}
