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

    /**
     * CallList constructor.
     * @param BaseClient $plivoClient
     * @param array $meta
     * @param array $resources
     */
    function __construct(BaseClient $plivoClient, $meta, array $resources)
    {
        parent::__construct($plivoClient, $meta, $resources);
    }

}