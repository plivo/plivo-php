<?php

namespace Plivo\Resources\Call;


use Plivo\Resources\ResponseUpdate;

/**
 * Class CallStream
 * @package Plivo\Resources\Call
 */
class CallStreamGetSpecificResponse extends ResponseUpdate
{
    protected $callUuid;
    protected $endTime;
    protected $serviceUrl;
    protected $startTime;
    protected $status;
    protected $statusCallbackUrl;
    protected $streamId;

    /**
     * CallStreamGetSpecificResponse constructor.
     * @param $apiID
     * @param $callUuid
     * @param $endTime
     * @param $serviceUrl
     * @param $startTime
     * @param $status
     * @param $statusCallbackUrl
     * @param $streamId
     * @param $statusCode
     */
    public function __construct($apiID, $callUuid, $endTime, $serviceUrl, $startTime, $status, $statusCallbackUrl, $streamId, $statusCode)
    {
        parent::__construct($apiID, '',$statusCode);

        $this->callUuid = $callUuid;
        $this->endTime = $endTime;
        $this->serviceUrl = $serviceUrl;
        $this->startTime = $startTime;
        $this->status = $status;
        $this->statusCallbackUrl = $statusCallbackUrl;
    }

    /**
     * @return mixed
     */
    public function getCallUuid()
    {
        return $this->callUuid;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @return mixed
     */
    public function getServiceUrl()
    {
        return $this->serviceUrl;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getStatusCallbackUrl()
    {
        return $this->statusCallbackUrl;
    }

    /**
     * @return mixed
     */
    public function getStreamId()
    {
        return $this->streamId;
    }

}