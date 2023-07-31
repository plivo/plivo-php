<?php

namespace Plivo\Resources\Verify;


use Plivo\Resources\ResponseUpdate;

/**
 * Class VerifySessionCreateResponse
 * @package Plivo\Resources\Verify
 */
class VerifySessionCreateResponse extends ResponseUpdate
{
    protected $sessionUuid;

    /**
     * VerifySessionCreateResponse constructor.
     * @param $message
     * @param $sessionUuid
     */
    public function __construct($message, $sessionUuid, $apiId, $statusCode)
    {
        parent::__construct($apiId, $message, $statusCode);
        $this->sessionUuid = $sessionUuid;
    }

    /**
     * Get the Session UUID
     * @return string
     */
    public function getSessionUuid()
    {
        return $this->sessionUuid;
    }


}