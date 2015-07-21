<?php
/*
 * Copyright (c) Plivo
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Plivo;

use Plivo\Element;
use Plivo\PlivoError;

class User extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('sendDigits', 'sendOnPreanswer', 'sipHeaders');

    function __construct($body, $attributes=array()) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No user set for ".$this->getName());
        }
    }
}