<?php

namespace Plivo\Resources\Call;


use Plivo\Resources\ResponseUpdate;

/**
 * Class CallStream
 * @package Plivo\Resources\Call
 */
class CallStream extends ResponseUpdate
{
    protected $streamId;

    /**
     * CallStream constructor.
     * @param string $streamId
     * @param string $message
     */
    public function __construct($apiID, $message, $streamId, $statusCode)
    {
        parent::__construct($apiID, $message,$statusCode);

        $this->streamId = $streamId;
    }

    public function getStreamId(): string
    {
        return $this->streamId;
    }
}