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

class Conference extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('muted','beep','startConferenceOnEnter',
                                        'endConferenceOnExit','waitSound','enterSound', 'exitSound',
                                        'timeLimit', 'hangupOnStar', 'maxMembers',
                                        'record', 'recordFileFormat','recordWhenAlone', 'action', 'method', 'redirect',
                                        'digitsMatch', 'callbackUrl', 'callbackMethod',
                                        'stayAlone', 'floorEvent',
                                        'transcriptionType', 'transcriptionUrl',
                                        'transcriptionMethod', 'relayDTMF');

    function __construct($body, $attributes=array()) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No conference name set for ".$this->getName());
        }
    }
}