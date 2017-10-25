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
        'Record',
        'Dial',
        'Redirect',
        'Wait',
        'Hangup',
        'PreAnswer',
        'Conference',
        'DTMF',
        'Message'
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
        $xml = parent::toXML(true);

        return $xml;
    }
}