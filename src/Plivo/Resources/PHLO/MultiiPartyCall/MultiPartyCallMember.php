<?php

namespace Plivo\Resources\PHLO\MultiPartyCall;

use Plivo\Resources\PHLO\Node\NodeMember;

class MultiPartyCallMember
{
    public $memberAddress;
    public $node;
    public $nodeMember;
    public $nodeUrl;
    public $client;

    public function __construct($memberAddress = null, $node = null, $nodeUrl = null, $client = null)
    {
        $this->memberAddress = $memberAddress;
        $this->node = $node;
        $this->client = $client;
        $this->nodeUrl = $nodeUrl;
    }

    public function __call($name, $arguments)
    {
        $this->nodeMember = new NodeMember('multi_party_call', $this->client, $this->nodeUrl, $this->memberAddress);
        return $this->nodeMember->$name();

    }
}