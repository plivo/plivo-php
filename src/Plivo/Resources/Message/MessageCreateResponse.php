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

    protected $invalidNumbers = [];

    /**
     * MessageCreateResponse constructor.
     * @param $message
     * @param array $messageUuid
     */
    public function __construct($message, array $messageUuid, $apiId,$statusCode, $invalid_numbers)
    {
        parent::__construct($apiId, $message,$statusCode);
        $this->messageUuid = $messageUuid;
        if($invalid_numbers != []){
            $this->invalidNumbers = $invalid_numbers;
        }
    }

    /**
     * Get the message ID
     * @return array
     */
    public function getMessageUuid()
    {
        return $this->messageUuid;
    }

    /**
     * Get the invalid numbers
     * @return array
     */
    public function getInvalidNumbers()
    {
        return $this->invalidNumbers;
    }


}