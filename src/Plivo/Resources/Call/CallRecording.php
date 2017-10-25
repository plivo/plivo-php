<?php

namespace Plivo\Resources\Call;


use Plivo\Resources\ResponseUpdate;

/**
 * Class CallRecording
 * @package Plivo\Resources\Call
 */
class CallRecording extends ResponseUpdate
{
    protected $url;
    protected $recordingId;

    /**
     * CallRecording constructor.
     * @param string $message
     * @param string $url
     * @param string $recordingId
     */
    public function __construct($message, $url, $recordingId)
    {
        parent::__construct($message);

        $this->url = $url;
        $this->recordingId = $recordingId;
    }
}