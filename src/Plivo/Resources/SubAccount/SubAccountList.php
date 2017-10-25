<?php

namespace Plivo\Resources\SubAccount;


use Plivo\BaseClient;
use Plivo\Resources\ResourceList;

/**
 * Class SubAccountList
 * @package Plivo\Resources\SubAccount
 */
class SubAccountList extends ResourceList
{
    /**
     * SubAccountList constructor.
     * @param BaseClient $plivoClient
     * @param array $meta
     * @param array $resources
     */
    function __construct(BaseClient $plivoClient, array $meta, array $resources)
    {
        parent::__construct($plivoClient, $meta, $resources);
    }
}