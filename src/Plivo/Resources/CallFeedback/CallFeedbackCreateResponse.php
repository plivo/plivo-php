<?php

namespace Plivo\Resources\CallFeedback;

use Plivo\Resources\ResponseUpdate;


/**
 * Class CallFeedbackCreateResponse
 * @package Plivo\Resources\CallFeedback
 */
class CallFeedbackCreateResponse extends ResponseUpdate
{
    protected $requestUuid;

    /**
     * CallFeedbackCreateResponse constructor.
     * @param $message
     * @param $requestUuid
     */
    public function __construct($apiId, $message, $statusCode )
    {
        parent::__construct($apiId, $message, $statusCode);
    }

}