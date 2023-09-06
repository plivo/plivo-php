<?php

namespace Plivo\Resources\MaskingSession;


use Plivo\BaseClient;
use Plivo\Resources\ResponseUpdate;

/**
 * Class MaskingSessionList
 * @package Plivo\Resources\Call
 */
// class MaskingSessionListResponse extends ResourceList
// {

//     /**
//      * MaskingSessionList constructor.
//      * @param BaseClient $plivoClient
//      * @param array $meta
//      * @param array $resources
//      */
//     function __construct(BaseClient $plivoClient, $meta, array $resources)
//     {
//         parent::__construct($plivoClient, $meta, $resources);
//     }

// }

class MaskingSessionListResponse extends ResponseUpdate
{
    protected $meta;
    protected $objects;

    /**
     * List all masking session constructor.
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