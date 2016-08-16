<?php

namespace Plivo;

class PreAnswer extends Element
{
    protected $nestables = ['Play', 'Speak', 'GetDigits', 'Wait', 'Redirect', 'Message', 'DTMF'];
    protected $valid_attributes = [];

    function __construct($attributes = [])
    {
        parent::__construct(null, $attributes);
    }
}
