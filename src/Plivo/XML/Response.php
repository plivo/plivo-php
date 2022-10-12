<?php

namespace Plivo\XML;


/**
 * Class Response
 * @package Plivo\XML
 */
class Response extends Element {
    protected $nestables = [
        'Speak',
        'Play',
        'GetDigits',
        'GetInput',
        'Record',
        'Dial',
        'Redirect',
        'Wait',
        'Hangup',
        'PreAnswer',
        'Conference',
        'DTMF',
        'Message',
        'MultiPartyCall',
        'Stream'
    ];

    /**
     * Response constructor.
     */
    function __construct() {
        parent::__construct(null);
    }

    /**
     * @param bool $header
     * @return mixed
     */
    public function toXML($header = false) {
        $xml = parent::toXML($header);
        return $xml;
    }
}