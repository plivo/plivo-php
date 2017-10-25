<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Conference
 * @package Plivo\XML
 */
class Conference extends Element {
    protected $nestables = [];

    protected $valid_attributes = [
        'muted',
        'beep',
        'startConferenceOnEnter',
        'endConferenceOnExit',
        'waitSound',
        'enterSound',
        'exitSound',
        'timeLimit',
        'hangupOnStar',
        'maxMembers',
        'record',
        'recordFileFormat',
        'recordWhenAlone',
        'action',
        'method',
        'redirect',
        'digitsMatch',
        'callbackUrl',
        'callbackMethod',
        'stayAlone',
        'floorEvent',
        'transcriptionType',
        'transcriptionUrl',
        'transcriptionMethod',
        'relayDTMF'
    ];

    /**
     * Conference constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoXMLException("No conference name set for ".$this->getName());
        }
    }
}