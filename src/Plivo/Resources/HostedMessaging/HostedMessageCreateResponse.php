<?php

namespace Plivo\Resources\HostedMessaging;

use Plivo\Resources\ResponseUpdate;

class HostedMessageCreateResponse extends ResponseUpdate {

    /**
     * @var
     */
    public $orderId;

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
    public $phoneNumber;

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
    public $hostingStatus;

    /**
     * @var
     */
    public $resourceUri;

    /**
     * @param $orderId
     * @param $application
     * @param $loaId
     * @param $phoneNumber
     * @param $alias
     * @param $createdAt
     * @param $failureReason
     * @param $hostingStatus
     * @param $resourceURI
     * @param $apiId
     * @param $message
     * @param $statusCode
     */
    public function __construct($orderId, $application, $loaId, $phoneNumber, $alias, $createdAt, $failureReason, $hostingStatus, $resourceURI, $apiId, $message, $statusCode)
    {
        parent::__construct($apiId, $message, $statusCode);
        $this->orderId = $orderId;
        $this->application = $application;
        $this->loaId = $loaId;
        $this->phoneNumber = $phoneNumber;
        $this->alias = $alias;
        $this->createdAt = $createdAt;
        $this->failureReason = $failureReason;
        $this->hostingStatus = $hostingStatus;
        $this->resourceUri = $resourceURI;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
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
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
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
    public function getHostingStatus()
    {
        return $this->hostingStatus;
    }

    /**
     * @return mixed
     */
    public function getResourceUri()
    {
        return $this->resourceUri;
    }
}