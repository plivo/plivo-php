<?php

namespace Plivo;

class Number extends Element
{
    protected $nestables = [];
    protected $valid_attributes = ['sendDigits', 'sendOnPreanswer', 'sendDigitsMode'];

    function __construct($body, $attributes = [])
    {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No number set for " . $this->getName());
        }
    }
}
