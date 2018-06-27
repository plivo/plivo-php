<?php

namespace Plivo\Resources\SubAccount;


use Plivo\Resources\ResponseUpdate;

/**
 * Class SubAccountCreateResponse
 * @package Plivo\Resources\SubAccount
 */
class SubAccountCreateResponse extends ResponseUpdate
{
    /**
     * @var string
     */
    protected $apiId;

    /**
     * @var string
     */
    protected $authId;
    /**
     * @var string
     */
    protected $authToken;

    /**
     * SubAccountCreateResponse constructor.
     * @param $message
     * @param $authId
     * @param $authToken
     */
    public function __construct($apiId, $authId, $authToken, $message)
    {
        parent::__construct($message);
        $this->authId = $authId;
        $this->authToken = $authToken;
        $this->apiId = $apiId;
    }

    /**
     * @return string
     */
    public function getAuthId()
    {
        return $this->authId;
    }

    /**
     * @return string
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @return string
     */
    public function getapiId()
    {
        return $this->apiId;
    }
}