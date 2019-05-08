<?php

namespace Plivo\Resources\PHLO\ConferenceBridge;

use Plivo\Resources\PHLO\Node\NodeClass;

/**
 * Class ConferenceBridge
 * @package Plivo\Resources\PHLO\ConferenceBridge
 */
class ConferenceBridge
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
    public $conferenceBridgeUrl;

    /**
     * ConferenceBridge constructor.
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

        $this->conferenceBridgeUrl = $this->phloUrl . "/conference_bridge/";
    }

    /**
     * @param $nodeId
     * @return ConferenceBridge
     */
    public function get($nodeId)
    {
        return new self($this->phlo, $nodeId, $this->phloUrl);
    }

    /**
     * @param $name
     * @param $arguments
     * @return ConferenceBridgeMember|\Plivo\Resources\PHLO\MultiPartyCall\MultiPartyCallMember
     */
    public function __call($name, $arguments)
    {
        $this->node = new NodeClass('conference_bridge', $this->nodeId, $this->phloId, $this->client, $this->conferenceBridgeUrl);
        return $this->node->member($arguments[0]);
    }
}