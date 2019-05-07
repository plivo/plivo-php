<?php

namespace Plivo\Resources\PHLO;

use Plivo\Resources\PHLO\MultiPartyCall\MultiPartyCall;
use Plivo\Resources\PHLO\ConferenceBridge\ConferenceBridge;
use Plivo\Resources\PHLO\Node\NodeClass;

/**
 * Class Phlo
 * @package Plivo\Resources\PHLO
 */
class Phlo
{
    /**
     * @var null
     */
    public $phloId;
    /**
     * @var
     */
    public $phlo;
    /**
     * @var
     */
    public $node;
    /**
     * @var
     */
    public $nodeMember;
    /**
     * @var
     */
    public $multiPartyCall;
    /**
     * @var
     */
    public $multiPartyCallMember;
    /**
     * @var
     */
    public $conferenceBridge;
    /**
     * @var
     */
    public $conferenceBridgeMember;
    /**
     * @var null
     */
    public $client;
    /**
     * @var string
     */
    public $phloUrl;
    /**
     * @var null
     */
    public $baseUrl;

    /**
     * Phlo constructor.
     * @param null $client
     * @param null $id
     * @param null $baseUrl
     */
    public function __construct($client = null, $id = null, $baseUrl = null)
    {
        $this->phloId = $id;
        $this->client = $client;
        $this->baseUrl = $baseUrl;
        $this->phloUrl =  $this->baseUrl . "/phlo/" . $this->phloId;
    }

    /**
     * @param $id
     * @return Phlo
     */
    public function get($id)
    {
        return new Phlo($this->client, $id, $this->baseUrl);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPhlo($id)
    {
        $phlo = new self($this->client, $id, $this->baseUrl); 
        $response = $phlo->client->getPhlorunner($phlo->phloUrl, []);
        return $response->getContent();
        // return json_encode($response->getContent(), JSON_FORCE_OBJECT);
    }

    /**
     * @param null $nodeType
     * @param null $nodeId
     * @return NodeClass
     */
    public function node($nodeType = null, $nodeId = null)
    {
        $this->node = new NodeClass($nodeType, $nodeId, null, $this->client, $this->phloUrl);
        return $this->node;
    }

    /**
     * @return MultiPartyCall
     */
    public function multiPartyCall()
    {
        $this->multiPartyCall = new MultiPartyCall($this, null, $this->phloUrl);
        return $this->multiPartyCall;
    }

    /**
     * @return ConferenceBridge
     */
    public function conferenceBridge()
    {
        $this->conferenceBridge = new ConferenceBridge($this, null, $this->phloUrl);
        return $this->conferenceBridge;
    }

    /**
     * @param $arguments
     * @return mixed
     */
    public function run($arguments = [])
    {
        $phlorunner = new Phlorunner($this->client, $this->phloId, $this->baseUrl);
        return $phlorunner->run($arguments, $this->client->authId);
    }
}