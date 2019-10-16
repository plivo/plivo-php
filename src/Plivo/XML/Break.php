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

        if(!empty($attributes)){
            foreach ($attributes as $key => $value) {
                if ($key ==='strength' && !in_array($value, $this->valid_strength_attribute_values)) {
                    throw new PlivoXMLException(
                        "invalid attribute value ".$value." for ".$key." ".$this->name);
                }
                if ($key ==='time'){
                    if (strpos($value, 'ms') !== false) {
                        $msec = explode('ms',$value);
                        if($msec[0] <0 || $msec[0] > 10000){
                            throw new PlivoXMLException(
                                "invalid attribute value ".$value." for ".$key." ".$this->name);
                        }
                    } else if (strpos($value, 's') !== false) {
                        $sec = explode('s',$value);
                        if($sec[0] <0 || $sec[0] > 10){
                            throw new PlivoXMLException(
                                "invalid attribute value ".$value." for ".$key." ".$this->name);
                        }
                    } else {
                        throw new PlivoXMLException(
                            "invalid attribute value ".$value." for ".$key." ".$this->name);
                    }
                }
                // if ($key ==='time' && !in_array($value, $this->valid_time_attribute_values)) {
                //     throw new PlivoXMLException(
                //         "invalid attribute value ".$value." for ".$key." ".$this->name);
                // }
            }
        }
        
        parent::__construct(null, $attributes);
        $this->name = strtolower($this->name);
    }
}
