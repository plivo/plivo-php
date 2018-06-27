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
     * CallList constructor.
     * @param BaseClient $plivoClient
     * @param array $meta
     * @param array $resources
     */

    private $apiId;

    function __construct(BaseClient $plivoClient, $meta, array $resources, $apiId)
    {
        parent::__construct($plivoClient, $meta, $resources);
        $this->apiId = $apiId;
    }

    /**
     * Get the API ID
     * @return mixed
     */
    public function getApiId()
    {
        return $this->apiId;
    }

}