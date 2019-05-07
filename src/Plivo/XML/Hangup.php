<?php

namespace Plivo\XML;


/**
 * Class Hangup
 * @package Plivo\XML
 */
class Hangup extends Element {
    protected $nestables = [];

    protected $valid_attributes = ['schedule', 'reason'];

    /**
     * Hangup constructor.
     * @param array $attributes
     */
    function __construct($attributes = []) {
        parent::__construct(null, $attributes);
    }
}