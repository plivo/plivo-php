<?php

namespace Plivo\XML;


/**
 * Class Record
 * @package Plivo\XML
 */
class Record extends Element {
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
        'transcriptionMethod'
    ];

    /**
     * Record constructor.
     * @param array $attributes
     */
    function __construct($attributes = []) {
        parent::__construct(null, $attributes);
    }
}