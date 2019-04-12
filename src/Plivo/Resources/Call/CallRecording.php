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
    public function __construct($url, $apiID, $recordingId, $message,$statusCode)
    {
        parent::__construct($apiID, $message,$statusCode);

        $this->url = $url;
        $this->recordingId = $recordingId;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getRecordingId()
    {
        return $this->recordingId;
    }
}