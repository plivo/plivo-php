<?php

namespace Plivo\Resources\PHLO\ConferenceBridge;

use Plivo\Resources\PHLO\Node\NodeMember;

/**
 * Class ConferenceBridgeMember
 * @package Plivo\Resources\PHLO\ConferenceBridge
 */
class ConferenceBridgeMember
{

    /**
     * @var null
     */
    public $memberAddress;
    /**
     * @var null
     */
    public $node;
    /**
     * @var
     */
    public $nodeMember;
    /**
     * @var null
     */
    public $nodeUrl;
    /**
     * @var null
     */
    public $client;

    /**
     * ConferenceBridgeMember constructor.
     * @param null $memberAddress
     * @param null $node
     * @param null $nodeUrl
     * @param null $client
     */
    public function __construct($memberAddress = null, $node = null, $nodeUrl = null, $client = null)
    {
        $this->memberAddress = $memberAddress;
        $this->node = $node;
        $this->client = $client;
        $this->nodeUrl = $nodeUrl;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $this->nodeMember = new NodeMember('conference_bridge', $this->client, $this->nodeUrl, $this->memberAddress);
        return $this->nodeMember->$name();

    }
}