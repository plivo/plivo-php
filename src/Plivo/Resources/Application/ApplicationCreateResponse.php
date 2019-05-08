<?php

namespace Plivo\Resources\Application;


use Plivo\Resources\ResponseUpdate;

/**
 * Class ApplicationCreateResponse
 * @package Plivo\Resources\Application
 */
class ApplicationCreateResponse extends ResponseUpdate
{

    /**
     * @var string Application ID
     */
    protected $appId;

    /**
     * ApplicationCreateResponse constructor.
     * @param $message
     * @param $appId
     */
    public function __construct($apiId, $appId, $message,$statusCode)
    {
        parent::__construct($apiId, $message,$statusCode);
        $this->appId = $appId;
    }

    /**
     * Get the application ID
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }
}