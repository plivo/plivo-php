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

    /**
     * CallCreateResponse constructor.
     * @param $message
     * @param $requestUuid
     */
    public function __construct($message, $requestUuid)
    {
        parent::__construct($message);
        $this->requestUuid = $requestUuid;
    }

    /**
     * Get the UUID of this request
     * @return mixed
     */
    public function getRequestUuid()
    {
        return $this->requestUuid;
    }


}