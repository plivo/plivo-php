<?php

namespace Plivo;

class Hangup extends Element
{
    protected $nestables = [];
    protected $valid_attributes = ['schedule', 'reason'];

    function __construct($attributes = [])
    {
        parent::__construct(null, $attributes);
    }
}
