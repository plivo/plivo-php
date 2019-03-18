<?php

namespace Plivo\Resources\PHLO\MultiPartyCall;

use Plivo\BaseClient;
use Plivo\Resources\PHLO\Node\NodeClass;
use Plivo\Resources\PHLO\Node\NodeMember;

/**
 * Class MultiPartyCall
 * @package Plivo\Resources\PHLO\MultiPartyCall
 */
class MultiPartyCall
{
    /**
     * @var
     */
    public $node;
    /**
     * @var null
     */
    public $nodeId;
    /**
     * @var null
     */
    public $phlo;
    /**
     * @var
     */
    public $phloId;
    /**
     * @var
     */
    public $client;
    /**
     * @var null
     */
    public $phloUrl;
    /**
     * @var string
     */
    public $multiPartyUrl;

    /**
     * MultiPartyCall constructor.
     * @param null $phlo
     * @param null $nodeId
     * @param null $phloUrl
     */
    public function __construct($phlo = null, $nodeId = null, $phloUrl = null)
    {
        $this->phlo = $phlo;
        $this->nodeId = $nodeId;
        $this->phloId = $phlo->phloId;
        $this->phloUrl = $phloUrl;
        $this->client = $phlo->client;

        $this->multiPartyUrl = $this->phloUrl . "/multi_party_call/";

    }

    /**
     * @param $nodeId
     * @return MultiPartyCall
     */
    public function get($nodeId)
    {
        return new MultiPartyCall($this->phlo, $nodeId, $this->phloUrl);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed|\Plivo\Resources\PHLO\ConferenceBridge\ConferenceBridgeMember|MultiPartyCallMember
     */
    public function __call($name, $arguments)
    {
        $this->node = new NodeClass('multi_party_call', $this->nodeId, $this->phloId, $this->client, $this->multiPartyUrl);

        if ($name === "member") {
            return $this->node->member($arguments[0]);
        } else {
            return $this->node->update($name, $arguments);
        }
    }
}