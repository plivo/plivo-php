<?php

namespace Plivo\Resources\HostedMessaging;


use Plivo\Resources\ResponseUpdate;

class HostedMessageLOACreateResponse extends ResponseUpdate {

    /**
     * @var
     */
    public $loaId;

    /**
     * @var
     */
    public $alias;

    /**
     * @var
     */
    public $linkedNumbers;

    /**
     * @var
     */
    public $apiId;

    /**
     * @var
     */
    public $file;

    /**
     * @var
     */
    public $createdAt;

    /**
     * @param $loaId
     * @param $alias
     * @param $linkedNumbers
     * @param $apiId
     * @param $file
     * @param $createdAt
     * @param $message
     * @param $statusCode
     */
    public function __construct($loaId, $alias, $linkedNumbers, $apiId, $file, $createdAt, $message, $statusCode)
    {
        parent::__construct($apiId, $message, $statusCode);
        $this->loaId = $loaId;
        $this->alias = $alias;
        $this->linkedNumbers = $linkedNumbers;
        $this->apiId = $apiId;
        $this->file = $file;
        $this->createdAt = $createdAt;
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
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @return mixed
     */
    public function getLinkedNumbers()
    {
        return $this->linkedNumbers;
    }

    /**
     * @return mixed
     */
    public function getApiId()
    {
        return $this->apiId;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
