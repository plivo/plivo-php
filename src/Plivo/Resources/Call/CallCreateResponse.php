<?php

namespace Plivo\Resources\Call;

use Plivo\Resources\ResponseUpdate;


/**
 * Class CallCreateResponse
 * @package Plivo\Resources\Call
 */
class CallCreateResponse extends ResponseUpdate
{
    protected $requestUuid;

    protected $invalidNumbers;

    /**
     * CallCreateResponse constructor.
     * @param $message
     * @param $requestUuid
     */
    public function __construct($apiId, $message, $requestUuid, $invalidNumbers, $statusCode)
    {
        parent::__construct($apiId, $message,$statusCode);
        $this->requestUuid = $requestUuid;
        $this->invalidNumbers = $invalidNumbers;
    }

    /**
     * Get the UUID of this request
     * @return mixed
     */
    public function getRequestUuid()
    {
        return $this->requestUuid;
    }

    /**
     * Get the invalidNumbers of this request
     * @return mixed
     */
    public function getInvalidNumbers()
    {
        return $this->invalidNumbers;
    }

}
