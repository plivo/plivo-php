<?php

namespace Plivo\Resources\Message;


use Plivo\Resources\ResponseUpdate;

/**
 * Class MessageCreateErrorResponse
 * @package Plivo\Resources\Message
 */
class MessageCreateErrorResponse extends ResponseUpdate
{
    protected $apiId = "";
    protected $error = "";
    /**
     * MessageCreateErrorResponse constructor.
     * @param $error
     * @param  $apiID
     */
    public function __construct($error, $apiId,$statusCode)
    {
        parent::__construct($apiId, $error, $statusCode);
        $this->apiID = $apiID;
        $this->error = $error;
    }

    /**
     * Get the message ID
     * @return array
     */
    public function getApiId()
    {
        return $this->apiId;
    }


}