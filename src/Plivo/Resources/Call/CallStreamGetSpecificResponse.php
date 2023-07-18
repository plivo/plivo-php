<?php

namespace Plivo\Resources\Call;


use Plivo\Resources\ResponseUpdate;

/**
 * Class CallStream
 * @package Plivo\Resources\Call
 */
class CallStreamGetSpecificResponse extends ResponseUpdate
{
    protected $audioTrack;
    protected $bidirectional;
    protected $billedAmount;
    protected $billDuration;
    protected $callUuid;
    protected $createdAt;
    protected $endTime;
    protected $plivoAuthId;
    protected $resourceUri;
    protected $roundedBillDuration;
    protected $serviceUrl;
    protected $startTime;
    protected $status;
    protected $statusCallbackUrl;
    protected $streamId;

    /**
     * CallStreamGetSpecificResponse constructor.
     * @param $apiID
     * @param $audioTrack
     * @param $bidirectional
     * @param $billedAmount
     * @param $billDuration
     * @param $callUuid
     * @param $createdAt
     * @param $endTime
     * @param $plivoAuthId
     * @param $resourceUri
     * @param $roundedBillDuration
     * @param $serviceUrl
     * @param $startTime
     * @param $status
     * @param $statusCallbackUrl
     * @param $statusCode
     * @param $streamId
     */
    public function __construct($apiID, $audioTrack, $bidirectional, $billedAmount, $billDuration, $callUuid, $createdAt, $endTime, $plivoAuthId, $resourceUri, $roundedBillDuration, $serviceUrl, $startTime, $status, $statusCallbackUrl, $streamId, $statusCode)
    {
        parent::__construct($apiID, '',$statusCode);

        $this->audioTrack = $audioTrack;
        $this->bidirectional = $bidirectional;
        $this->billedAmount = $billedAmount;
        $this->billDuration = $billDuration;
        $this->callUuid = $callUuid;
        $this->createdAt = $createdAt;
        $this->endTime = $endTime;
        $this->plivoAuthId = $plivoAuthId;
        $this->resourceUri = $resourceUri;
        $this->roundedBillDuration = $roundedBillDuration;
        $this->serviceUrl = $serviceUrl;
        $this->startTime = $startTime;
        $this->status = $status;
        $this->statusCallbackUrl = $statusCallbackUrl;
        $this->streamId = $streamId;
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
    public function getAudioTrack()
    {
        return $this->audioTrack;
    }

    /**
     * @return mixed
     */
    public function getBidirectional()
    {
        return $this->bidirectional;
    }

    /**
     * @return mixed
     */
    public function getBilledAmount()
    {
        return $this->billedAmount;
    }

    /**
     * @return mixed
     */
    public function getBillDuration()
    {
        return $this->billDuration;
    }


    /**
     * @return mixed
     */
    public function getRoundedBillDuration()
    {
        return $this->roundedBillDuration;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getPlivoAuthId()
    {
        return $this->plivoAuthId;
    }

    /**
     * @return mixed
     */
    public function getResourceUri()
    {
        return $this->resourceUri;
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