<?php

namespace Plivo\Resources\PHLO\Node;

use Plivo\Resources\PHLO\ConferenceBridge\ConferenceBridgeMember;
use Plivo\Resources\PHLO\MultiPartyCall\MultiPartyCall;
use Plivo\Resources\PHLO\MultiPartyCall\MultiPartyCallMember;

/**
 * Class NodeClass
 * @package Plivo\Resources\PHLO\Node
 */
class NodeClass
{
    /**
     * @var null
     */
    public $nodeType;
    /**
     * @var null
     */
    public $nodeId;
    /**
     * @var
     */
    public $node;
    /**
     * @var null
     */
    public $phloId;
    /**
     * @var null
     */
    public $client;
    /**
     * @var string
     */
    public $nodeUrl;

    /**
     * NodeClass constructor.
     * @param null $nodeType
     * @param null $nodeId
     * @param null $phloId
     * @param null $client
     * @param null $servicesUrl
     */
    public function __construct($nodeType = null, $nodeId = null, $phloId = null, $client = null, $servicesUrl = null)
    {
        $this->nodeType = $nodeType;
        $this->nodeId = $nodeId;
        $this->phloId = $phloId;
        $this->client = $client;
        $this->servicesUrl = $servicesUrl;

        $this->nodeUrl = $servicesUrl . $this->nodeId;
    }

    /**
     * @param $id
     * @return null
     */
    public function get($id)
    {
        $node = new self(null, $id, null, null, $this->phloUrl);
        $this->nodeId = $id;
        return $this->nodeId;
    }

    /**
     * @return mixed
     */
    public function getNode()
    {
        $node = new self(null, null, null, null, $this->servicesUrl);
        $url = $this->servicesUrl . "/" . $this->nodeType . "/" . $this->nodeId;
        $response = $this->client->getPhlorunnerApis($url, []);
        return $response;
    }

    /**
     * @param $action
     * @param $arguments
     * @return mixed
     */
    public function update($action, $arguments)
    {
        $params = [
            "action" => $action,
            "trigger_source" => $arguments[0],
            "to" => $arguments[1],
            "role" => $arguments[2]
        ];

        $response = $this->client->updateNode($this->nodeUrl, $params);
        return $response->getContent();
        // return json_encode($response->getContent(), JSON_FORCE_OBJECT);
    }

    /**
     * @param $memberAddress
     * @return ConferenceBridgeMember|MultiPartyCallMember
     */
    public function member($memberAddress)
    {
        if ($this->nodeType === "multi_party_call") {
            return new MultiPartyCallMember($memberAddress, $this, $this->nodeUrl, $this->client);
        } else if ($this->nodeType === "conference_bridge") {
            return new ConferenceBridgeMember($memberAddress, $this, $this->nodeUrl, $this->client);
        }
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $multiPartyCall = new MultiPartyCall(null, $this->nodeId, $this->client);
        return $multiPartyCall->$name($arguments);
    }
}