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

    public $apiId;

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