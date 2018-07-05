<?php

namespace Plivo\Resources\Message;


use Plivo\Resources\ResponseUpdate;

/**
 * Class MessageCreateResponse
 * @package Plivo\Resources\Message
 */
class MessageCreateResponse extends ResponseUpdate
{
    protected $messageUuid = [];

    /**
     * MessageCreateResponse constructor.
     * @param $message
     * @param array $messageUuid
     */
    public function __construct($message, array $messageUuid, $apiId)
    {
        parent::__construct($apiId, $message);
        $this->messageUuid = $messageUuid;
    }

    /**
     * Get the message ID
     * @return array
     */
    public function getMessageUuid()
    {
        return $this->messageUuid;
    }


}