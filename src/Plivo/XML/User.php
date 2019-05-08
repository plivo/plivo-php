<?php

namespace Plivo\XML;

use Plivo\Exceptions\PlivoXMLException;


/**
 * Class User
 * @package Plivo\XML
 */
class User extends Element {
    protected $nestables = [];

    protected $valid_attributes = ['sendDigits', 'sendOnPreanswer', 'sipHeaders'];

    /**
     * User constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoXMLException("No user set for ".$this->getName());
        }
    }
}