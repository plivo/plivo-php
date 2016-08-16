<?php

namespace Plivo;

class Speak extends Element
{
    protected $nestables = [];
    protected $valid_attributes = ['voice', 'language', 'loop'];

    function __construct($body, $attributes = [])
    {
        if (!$body) {
            throw new PlivoError("No text set for " . $this->getName());
        } else {
            $body = mb_encode_numericentity($body, [0x80, 0xffff, 0, 0xffff]);
        }
        parent::__construct($body, $attributes);
    }
}
