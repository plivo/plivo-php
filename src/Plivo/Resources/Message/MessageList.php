<?php

namespace Plivo\Resources\Message;


use Plivo\MessageClient;
use Plivo\Resources\ResourceList;

/**
 * Class MessageList
 * @package Plivo\Resources\Message
 */
class MessageList extends ResourceList
{

    /**
     * MessageList constructor.
     * @param MessageClient $plivoClient
     * @param $meta
     * @param array $resources
     */
    function __construct(MessageClient $plivoClient, $meta, array $resources)
    {
        parent::__construct($plivoClient, $meta, $resources);
    }
}