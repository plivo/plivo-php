<?php

namespace Plivo;

class DTMF extends Element
{
    protected $nestables = [];
    protected $valid_attributes = ['async'];

    function __construct($body, $attributes = [])
    {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No digits set for " . $this->getName());
        }
    }
}
