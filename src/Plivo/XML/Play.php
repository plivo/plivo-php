<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Play
 * @package Plivo\XML
 */
class Play extends Element {
    protected $nestables = [];

    protected $valid_attributes = ['loop'];

    /**
     * Play constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoXMLException("No url set for ".$this->getName());
        }
    }
}