<?php

namespace Plivo\Resources\PHLO\Node;

/**
 * Class NodeMember
 * @package Plivo\Resources\PHLO\Node
 */
class NodeMember
{
    /**
     * @var
     */
    public $nodeType;
    /**
     * @var
     */
    public $node;
    /**
     * @var string
     */
    public $nodeMemberUrl;
    /**
     * @var null
     */
    public $client;

    /**
     * NodeMember constructor.
     * @param $nodeType
     * @param null $client
     * @param null $nodeUrl
     * @param $memberAddress
     */
    public function __construct($nodeType, $client = null, $nodeUrl = null, $memberAddress)
    {
        $this->nodeType = $nodeType;
        $this->client = $client;

        $this->nodeMemberUrl = $nodeUrl . '/members/' . $memberAddress;
    }

    /**
     * @param $name
     * @param null $arguments
     * @return mixed
     */
    public function __call($name, $arguments = null)
    {
        $params =  [
            "action" => $name
        ];

        $response = $this->client->updateNode($this->nodeMemberUrl, $params);
        return $response->getContent();
        // return json_encode($response->getContent(), JSON_FORCE_OBJECT);
    }
}