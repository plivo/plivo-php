<?php

namespace Plivo\Resources\PhoneNumber;

use Plivo\BaseClient;
use Plivo\Resources\ResourceList;

/**
 * Class PhoneNumberListResponse
 * @package Plivo\Resources\PhoneNumber
 */
class PhoneNumberListResponse extends ResourceList
{
    // String 
    public $error;
    
    /**
     * PhoneNumberListResponse constructor.
     * @param BaseClient $plivoClient
     * @param $meta
     * @param array $resources
     * @param error $error
     */
    public function __construct(BaseClient $plivoClient, array $meta, array $resources, $error)
    {
        parent::__construct($plivoClient, $meta, $resources);

        $this->error = $error;
    }
}