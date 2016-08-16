<?php

namespace Plivo;

class Message extends Element
{
    protected $nestables = [];
    protected $valid_attributes = ['src', 'dst', 'type', 'callbackMethod', 'callbackUrl'];

    function __construct($body, $attributes = [])
    {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No text set for " . $this->getName());
        }
    }
}