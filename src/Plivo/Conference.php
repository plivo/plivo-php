<?php

namespace Plivo;

class Conference extends Element
{
    protected $nestables = [];
    protected $valid_attributes = [
        'muted',
        'beep',
        'startConferenceOnEnter',
        'endConferenceOnExit',
        'waitSound',
        'enterSound',
        'exitSound',
        'timeLimit',
        'hangupOnStar',
        'maxMembers',
        'record',
        'recordFileFormat',
        'recordWhenAlone',
        'action',
        'method',
        'redirect',
        'digitsMatch',
        'callbackUrl',
        'callbackMethod',
        'stayAlone',
        'floorEvent',
        'transcriptionType',
        'transcriptionUrl',
        'transcriptionMethod',
        'relayDTMF',
    ];

    function __construct($body, $attributes = [])
    {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No conference name set for " . $this->getName());
        }
    }
}