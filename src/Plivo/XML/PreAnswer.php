<?php

namespace Plivo\XML;


/**
 * Class PreAnswer
 * @package Plivo\XML
 */
class PreAnswer extends Element {
    protected $nestables = ['Play', 'Speak', 'GetDigits', 'Wait', 'Redirect', 'Message', 'DTMF'];

    protected $valid_attributes = [];

    /**
     * PreAnswer constructor.
     * @param array $attributes
     */
    function __construct($attributes = []) {
        parent::__construct(null, $attributes);
    }
}