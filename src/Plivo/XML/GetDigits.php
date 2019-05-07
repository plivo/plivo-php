<?php

namespace Plivo\XML;


/**
 * Class GetDigits
 * @package Plivo\XML
 */
class GetDigits extends Element {
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
        'log'
    ];

    /**
     * GetDigits constructor.
     * @param array $attributes
     */
    function __construct($attributes = []) {
        parent::__construct(null, $attributes);
    }
}