<?php

namespace Plivo;

class Response extends Element {
    protected $nestables = array(
        'Speak',
        'Play',
        'GetDigits',
        'Record',
        'Dial',
        'Redirect',
        'Wait',
        'Hangup',
        'PreAnswer',
        'Conference',
        'DTMF',
        'Message'
   );

    function __construct() {
        parent::__construct(null);
    }

    public function toXML($header = false) {
        $xml = parent::toXML(true);

        return $xml;
    }
}
