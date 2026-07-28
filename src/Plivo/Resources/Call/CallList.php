<?php

namespace Plivo\Resources\Call;


use Plivo\BaseClient;
use Plivo\Resources\ResourceList;

/**
 * Class CallList
 * @package Plivo\Resources\Call
 */
class CallList extends ResourceList
{
    public $statusCode;

    /**
     * CallList constructor.
     * @param BaseClient $plivoClient
     * @param array $meta
     * @param array $resources
     */
    function __construct(BaseClient $plivoClient, $meta, array $resources, $statusCode)
    {
        parent::__construct($plivoClient, $meta, $resources);
        $this->statusCode = $statusCode;
    }

}