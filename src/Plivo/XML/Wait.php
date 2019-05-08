<?php

namespace Plivo\XML;


/**
 * Class Wait
 * @package Plivo\XML
 */
class Wait extends Element {
    protected $nestables = [];

    protected $valid_attributes = ['length', 'silence', 'min_silence', 'minSilence', 'beep'];

    /**
     * Wait constructor.
     * @param array $attributes
     */
    function __construct($attributes = []) {
        parent::__construct(null, $attributes);
    }
}