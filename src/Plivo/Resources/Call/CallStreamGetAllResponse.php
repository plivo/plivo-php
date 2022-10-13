<?php

namespace Plivo\Resources\Call;


use Plivo\Resources\ResponseUpdate;

/**
 * Class CallStream
 * @package Plivo\Resources\Call
 */
class CallStreamGetAllResponse extends ResponseUpdate
{
    protected $meta;
    protected $objects;

    /**
     * CallStreamGetAllResponse constructor.
     * @param $apiID
     * @param string $message
     * @param $meta
     * @param $objects
     * @param $statusCode
     */
    public function __construct($apiID, $message, $meta, $objects, $statusCode)
    {
        parent::__construct($apiID, $message,$statusCode);

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