<?php

namespace Plivo\Resources\Application;

use Plivo\BaseClient;
use Plivo\Resources\ResourceList;

/**
 * Class ApplicationList
 * @package Plivo\Resources\Application
 */
class ApplicationList extends ResourceList
{
    /**
     * ApplicationList constructor.
     * @param BaseClient $plivoClient
     * @param $meta
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