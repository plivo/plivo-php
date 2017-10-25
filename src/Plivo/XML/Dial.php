<?php

namespace Plivo\XML;


/**
 * Class Dial
 * @package Plivo\XML
 */
class Dial extends Element {
    protected $nestables = ['Number', 'User'];

    protected $valid_attributes = [
        'action',
        'method',
        'timeout',
        'hangupOnStar',
        'timeLimit',
        'callerId',
        'callerName',
        'confirmSound',
        'dialMusic',
        'confirmKey',
        'redirect',
        'callbackUrl',
        'callbackMethod',
        'digitsMatch',
        'digitsMatchBLeg',
        'sipHeaders'
    ];

    /**
     * Dial constructor.
     * @param array $attributes
     */
    function __construct($attributes = []) {
        parent::__construct(null, $attributes);
    }
}