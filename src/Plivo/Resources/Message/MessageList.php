<?php

namespace Plivo\Resources\Message;


use Plivo\BaseClient;
use Plivo\Resources\ResourceList;

/**
 * Class MessageList
 * @package Plivo\Resources\Message
 */
class MessageList extends ResourceList
{

    /**
     * MessageList constructor.
     * @param BaseClient $plivoClient
     * @param $meta
     * @param array $resources
     */
    function __construct(BaseClient $plivoClient, $meta, array $resources)
    {
        parent::__construct($plivoClient, $meta, $resources);
    }
}