<?php

namespace Plivo\Resources\PHLO;

use Plivo\BaseClient;

/**
 * Class PhloRestClient
 * @package Plivo\Resources\PHLO
 */
class PhloRestClient
{
    /**
     * @var string
     */
    public $baseUrl = "https://phlorunner.plivo.com/v1";
    /**
     * @var BaseClient
     */
    public $client;
    /**
     * @var Phlo
     */
    public $phlo;

    /**
     * PhloRestClient constructor.
     * @param null $authId
     * @param null $authToken
     */
    public function __construct($authId = null, $authToken = null)
    {
        $this->client = new BaseClient($authId, $authToken);

        $this->phlo = new Phlo($this->client, null, $this->baseUrl);
    }

}