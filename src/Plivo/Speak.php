<?php

namespace Plivo;

class Speak extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('voice', 'language', 'loop');

    function __construct($body, $attributes = array()) {
        if (!$body) {
            throw new PlivoError("No text set for ".$this->getName());
        } else {
           $body = mb_encode_numericentity($body, array(0x80, 0xffff, 0, 0xffff));
        }
        parent::__construct($body, $attributes);
    }
}
