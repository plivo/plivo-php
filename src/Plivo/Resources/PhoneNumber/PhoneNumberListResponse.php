<?php

namespace Plivo\Resources\PhoneNumber;


use Plivo\Resources\ResponseUpdate;

/**
 * Class PhoneNumberListResponse
 * @package Plivo\Resources\PhoneNumber
 */
class PhoneNumberListResponse extends ResourceList
{
    // String 
    protected $error;
    
    /**
     * PhoneNumberListResponse constructor.
     * @param BaseClient $plivoClient
     * @param $meta
     * @param array $resources
     * @param error $error
     */
    public function __construct(BaseClient $plivoClient, array $meta, array $resources, $error)
    {
        parent::__construct($apiID, $message, $statusCode);

        $this->error = $error;
    }
}