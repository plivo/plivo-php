<?php

namespace Plivo\XML;


/**
 * Class GetInput
 * @package Plivo\XML
 */
class GetInput extends Element {
    protected $nestables = ['Speak', 'Play', 'Wait'];

    protected $valid_attributes = [
        'action',
        'method',
        'inputType',
        'executionTimeout',
        'digitEndTimeout',
        'speechEndTimeout',
        'finishOnKey',
        'numDigits',
        'speechModel',
        'hints',
        'language',
        'interimSpeechResultsCallback',
        'interimSpeechResultsCallbackMethod',
        'log',
        'redirect',
        'profanityFilter'
    ];

    /**
     * GetInput constructor.
     * @param array $attributes
     */
    function __construct($attributes = []) {
        parent::__construct(null, $attributes);
    }
}