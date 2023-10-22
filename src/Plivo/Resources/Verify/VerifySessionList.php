<?php

namespace Plivo\Resources\Verify;


use Plivo\BaseClient;
use Plivo\Resources\ResourceList;

/**
 * Class VerifySessionList
 * @package Plivo\Resources\Verify
 */
class VerifySessionList extends ResourceList
{

    /**
     * @var
     */
    public $apiId;

    /**
     * VerifySessionList constructor.
     * @param BaseClient $plivoClient
     * @param $meta
     * @param array $resources
     * @param string $apiId
     */
    function __construct(BaseClient $plivoClient, $meta, array $resources, $apiId=null)
    {
        parent::__construct($plivoClient, $meta, $resources);
        $this->apiId = $apiId;
    }
}