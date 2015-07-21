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
    protected $nestables = array();

    protected $valid_attributes = array('length', 'silence', 'min_silence', 'minSilence', 'beep');

    function __construct($attributes=array()) {
        parent::__construct(NULL, $attributes);
    }
}