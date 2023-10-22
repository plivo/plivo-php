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
     * @var
     */
    public $apiId;

    /**
     * MessageList constructor.
     * @param MessageClient $plivoClient
     * @param $meta
     * @param array $resources
     * @param string $apiId
     */
    function __construct(MessageClient $plivoClient, $meta, array $resources, $apiId=null)
    {
        parent::__construct($plivoClient, $meta, $resources);
        $this->apiId = $apiId;
    }
}