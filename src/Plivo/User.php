<?php

namespace Plivo;

class User extends Element
{
    protected $nestables = [];
    protected $valid_attributes = ['sendDigits', 'sendOnPreanswer', 'sipHeaders'];

    function __construct($body, $attributes = [])
    {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No user set for " . $this->getName());
        }
    }
}