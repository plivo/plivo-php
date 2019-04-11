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
    public function __construct($message, array $messageUuid, $apiId,$statusCode)
    {
        parent::__construct($apiId, $message,$statusCode);
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