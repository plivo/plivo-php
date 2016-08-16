<?php

namespace Plivo;

class Wait extends Element
{
    protected $nestables = [];
    protected $valid_attributes = ['length', 'silence', 'min_silence', 'minSilence', 'beep'];

    function __construct($attributes = [])
    {
        parent::__construct(null, $attributes);
    }
}