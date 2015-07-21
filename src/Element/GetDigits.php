<?php
/*
 * Copyright (c) Plivo
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Plivo;

use Plivo\Element;

class Wait extends Element {
    protected $nestables = array('Speak', 'Play', 'Wait');

    protected $valid_attributes = array('action', 'method', 'timeout', 'digitTimeout',
                                        'numDigits', 'retries', 'invalidDigitsSound',
                                        'validDigits', 'playBeep', 'redirect', "finishOnKey",
                                        'digitTimeout', 'log');

    function __construct($attributes=array()) {
        parent::__construct(NULL, $attributes);
    }
}