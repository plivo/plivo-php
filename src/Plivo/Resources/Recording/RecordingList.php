<?php

namespace Plivo\Resources\Recording;


use Plivo\BaseClient;
use Plivo\Resources\ResourceList;

/**
 * Class CallList
 * @package Plivo\Resources\Call
 */
class RecordingList extends ResourceList
{
    public $statusCode;

    function __construct(BaseClient $plivoClient, $meta, array $resources, $statusCode)
    {
        parent::__construct($plivoClient, $meta, $resources);
        $this->statusCode = $statusCode;
    }

}