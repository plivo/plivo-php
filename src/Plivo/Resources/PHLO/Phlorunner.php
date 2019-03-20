<?php

namespace Plivo\Resources\PHLO;


/**
 * Class Phlorunner
 * @package Plivo\Resources\PHLO
 */
class Phlorunner
{
    /**
     * @var
     */
    public $client;
    /**
     * @var
     */
    public $authId;
    /**
     * @var
     */
    public $phloId;
    /**
     * @var string
     */
    public $phlorunnerUrl;
    /**
     * @var
     */
    public $baseUrl;

    /**
     * Phlorunner constructor.
     * @param $client
     * @param $phloId
     * @param $baseUrl
     */
    public function __construct($client, $phloId, $baseUrl)
    {
        $this->client = $client;
        $this->authId = $client->authId;
        $this->phloId = $phloId;
        $this->baseUrl = $baseUrl;
        $this->phlorunnerUrl = $baseUrl . "/account/" . $this->authId . "/phlo/" . $this->phloId;
    }

    /**
     * @param $arguments
     * @param $authId
     * @return mixed
     */
    public function run($arguments = [] , $authId = null)
    {
        $headers = [
            "authId" => $authId
        ];
        $response = $this->client->getPhlorunnerApis($this->phlorunnerUrl, $arguments, $headers);
        return $response->getContent();
        // return json_encode($response->getContent(), JSON_FORCE_OBJECT);
    }
}
