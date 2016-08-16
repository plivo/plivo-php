<?php

namespace Plivo;

class Play extends Element
{
    protected $nestables = [];
    protected $valid_attributes = ['loop'];

    function __construct($body, $attributes = [])
    {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No url set for " . $this->getName());
        }
    }
}