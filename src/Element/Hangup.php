<?php
/*
 * Copyright (c) Plivo
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Plivo;

use Plivo\Element;

class Hangup extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('schedule', 'reason');

    function __construct($attributes=array()) {
        parent::__construct(NULL, $attributes);
    }
}