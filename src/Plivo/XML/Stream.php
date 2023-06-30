<?php

namespace Plivo\XML;


/**
 * Class Stream
 * @package Plivo\XML
 */
class Stream extends Element
{
    protected $nestables = [];

    protected $valid_attributes = [
        'bidirectional',
        'audioTrack',
        'streamTimeout',
        'statusCallbackUrl',
        'statusCallbackMethod',
        'contentType',
        'extraHeaders'
    ];

    /**
     * Record constructor.
     * @param array $attributes
     */
    function __construct($body, $attributes = [])
    {
        parent::__construct($body, $attributes);
    }
}