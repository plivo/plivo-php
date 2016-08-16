<?php

namespace Plivo;

class Record extends Element
{
    protected $nestables = [];
    protected $valid_attributes = [
        'action',
        'method',
        'timeout',
        'finishOnKey',
        'maxLength',
        'playBeep',
        'recordSession',
        'startOnDialAnswer',
        'redirect',
        'fileFormat',
        'callbackUrl',
        'callbackMethod',
        'transcriptionType',
        'transcriptionUrl',
        'transcriptionMethod',
    ];

    function __construct($attributes = [])
    {
        parent::__construct(null, $attributes);
    }
}