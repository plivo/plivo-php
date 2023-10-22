<?php

namespace Plivo\Resources\Token;

use Plivo\Resources\ResponseUpdate;


/**
 * Class TokenCreateResponse
 * @package Plivo\Resources\Token
 */
class TokenCreateResponse extends ResponseUpdate
{
    /**
     * TokenCreateResponse constructor.
     * @param $message
     */
    public function __construct($apiId, $message,$statusCode )
    {
        parent::__construct($apiId, $message,$statusCode);
    }
}