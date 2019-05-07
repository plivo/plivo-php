<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Redirect
 * @package Plivo\XML
 */
class Redirect extends Element {
    protected $nestables = [];

    protected $valid_attributes = ['method'];

    /**
     * Redirect constructor.
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