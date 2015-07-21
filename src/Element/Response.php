<?php
/*
 * Copyright (c) Plivo
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Plivo;

use Plivo\Element;

class Response extends Element {
    protected $nestables = array('Speak', 'Play', 'GetDigits', 'Record',
                                 'Dial', 'Redirect', 'Wait', 'Hangup',
                                 'PreAnswer', 'Conference', 'DTMF', 'Message');

    function __construct() {
        parent::__construct(NULL);
    }

    public function toXML($header = true) {
        $xml = parent::toXML($header);
        return $xml;
    }
}