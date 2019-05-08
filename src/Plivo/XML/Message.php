<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Message
 * @package Plivo\XML
 */
class Message extends Element {
    protected $nestables = [];

    protected $valid_attributes = ['src', 'dst', 'type', 'callbackMethod', 'callbackUrl'];

    /**
     * Message constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoXMLException("No text set for ".$this->getName());
        }
    }
}