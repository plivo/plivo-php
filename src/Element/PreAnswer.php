<?php
/*
 * Copyright (c) Plivo
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Plivo;

use Plivo\Element;

class PreAnswer extends Element {
    protected $nestables = array('Play', 'Speak', 'GetDigits', 'Wait', 'Redirect', 'Message', 'DTMF');

    protected $valid_attributes = array();

    function __construct($attributes=array()) {
        parent::__construct(NULL, $attributes);
    }
}