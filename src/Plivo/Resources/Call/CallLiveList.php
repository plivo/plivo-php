<?php

namespace Plivo\Resources\Call;


use Plivo\BaseClient;
use Plivo\Resources\ResourceList;

/**
 * Class CallLiveList
 * @package Plivo\Resources\Call
 */
class CallLiveList extends ResourceList
{

    /**
     * CallLiveList constructor.
     * @param BaseClient $plivoClient
     * @param array $meta
     * @param array $resources
     */
    function __construct(BaseClient $plivoClient, $meta, array $resources)
    {
        parent::__construct($plivoClient, $meta, $resources);
    }

}