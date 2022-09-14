<?php

namespace Plivo\Resources\Campaign;


use Plivo\BaseClient;
use Plivo\Resources\ResourceList;

/**
 * Class CampaignList
 * @package Plivo\Resources\Campaign
 */
class CampaignList extends ResourceList
{
    /**
     * CampaignList constructor.
     * @param BaseClient $plivoClient
     * @param array $meta
     * @param array $resources
     */
    function __construct(BaseClient $plivoClient, array $meta, array $resources)
    {
        parent::__construct($plivoClient, $meta, $resources);
    }
}