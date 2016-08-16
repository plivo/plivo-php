<?php

namespace Plivo;

class GetDigits extends Element
{
    protected $nestables = ['Speak', 'Play', 'Wait'];
    protected $valid_attributes = [
        'action',
        'method',
        'timeout',
        'digitTimeout',
        'numDigits',
        'retries',
        'invalidDigitsSound',
        'validDigits',
        'playBeep',
        'redirect',
        "finishOnKey",
        'digitTimeout',
        'log',
    ];

    function __construct($attributes = [])
    {
        parent::__construct(null, $attributes);
    }
}
