<?php

namespace Plivo\Resources\HostedMessaging;

use Plivo\Resources\ResponseUpdate;

class HostedMessageCreateResponse extends ResponseUpdate {

    /**
     * @var
     */
    public $hostedMessagingNumberId;

    /**
     * @var
     */
    public $application;

    /**
     * @var
     */
    public $loaId;

    /**
     * @var
     */
    public $number;

    /**
     * @var
     */
    public $alias;

    /**
     * @var
     */
    public $createdAt;

    /**
     * @var
     */
    public $failureReason;

    /**
     * @var
     */
    public $hostedStatus;

    /**
     * @var
     */
    public $resourceUri;

    /**
     * @param $hostedMessagingNumberId
     * @param $application
     * @param $loaId
     * @param $number
     * @param $alias
     * @param $createdAt
     * @param $failureReason
     * @param $hostedStatus
     * @param $resourceURI
     * @param $apiId
     * @param $message
     * @param $statusCode
     */
    public function __construct($hostedMessagingNumberId, $application, $loaId, $number, $alias, $createdAt, $failureReason, $hostedStatus, $resourceURI, $apiId, $message, $statusCode)
    {
        parent::__construct($apiId, $message, $statusCode);
        $this->hostedMessagingNumberId = $hostedMessagingNumberId;
        $this->application = $application;
        $this->loaId = $loaId;
        $this->number = $number;
        $this->alias = $alias;
        $this->createdAt = $createdAt;
        $this->failureReason = $failureReason;
        $this->hostedStatus = $hostedStatus;
        $this->resourceUri = $resourceURI;
    }

    /**
     * @return mixed
     */
    public function getHostedMessagingNumberId()
    {
        return $this->hostedMessagingNumberId;
    }

    /**
     * @return mixed
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @return mixed
     */
    public function getLoaId()
    {
        return $this->loaId;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
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
    public function getFailureReason()
    {
        return $this->failureReason;
    }

    /**
     * @return mixed
     */
    public function getHostedStatus()
    {
        return $this->hostedStatus;
    }

    /**
     * @return mixed
     */
    public function getResourceUri()
    {
        return $this->resourceUri;
    }
}