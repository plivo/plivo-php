<?php

namespace Plivo\Resources\VerifyCallerId;

use Plivo\Resources\ResponseUpdate;

/**
 * Class ListVerifiedCallerIdResponse
 * @package Plivo\Resources\VerifyCallerId
 */

class ListVerifiedCallerIdResponse extends ResponseUpdate{

    protected $meta;

    protected $objects;

    /**
     * Verify constructor.
     * @param $apiID
     * @param $meta
     * @param $objects
     * @param $statusCode
     */

    public function __construct($apiID, $meta, $objects, $statusCode)
    {
        parent::__construct($apiID, '',$statusCode);

        $this->meta = $meta;
        $this->objects = $objects;
    }

    public function getMeta()
    {
        return $this->meta;
    }

    public function getObjects()
    {
        return $this->objects;
    }

    
}
