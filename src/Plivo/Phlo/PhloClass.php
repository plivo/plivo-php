<?php

namespace Plivo\Phlo;

use Illuminate\Http\Request;
use Plivo\Phlo\MultiPartyCall\MultiPartyCall;
use Plivo\Phlo\ConferenceBridge\ConferenceBridge;

/**
 * Class Phlo
 * @package Plivo\Phlo
 */
class PhloClass
{
    /**
     * @var
     */
    const BASE_PHLO_URL = "https://phlorunner.plivo.com/v1/phlo/";
    /**
     * @var PhloClass
     */
    public $phloId;
    /**
     * @var NodeType
     */
    public $node;

    /**
     * Phlo constructor.
     * @param $phloId
     */
    public function __construct($phloId)
    {
        $this->phloId = $phloId;
    }

    /**
     * @param $nodeId
     * @param $client
     * @return MultiPartyCall
     */
    public function multiPartyCall($nodeId, $client)
    {
        $this->node = new MultiPartyCall($nodeId, $this->phloId, self::BASE_PHLO_URL, $client);
    }

    /**
     * @param $nodeId
     * @param $client
     */
    public function conferenceBridge($nodeId, $client)
    {
        $this->node = new ConferenceBridge($nodeId, $this->phloId, self::BASE_PHLO_URL, $client);
    }

    /**
     * @param $nodeType
     * @param $nodeId
     * @param $client
     * @return mixed
     */
    public function node($nodeType, $nodeId, $client) {
        if($nodeType === "multi_party_call") {
            $this->multiPartyCall($nodeId, $client);
            return $this->node;
        } else if($nodeType === "conference_bridge") {
            $this->conferenceBridge($nodeId, $client);
            return $this->node;
        }
    }
}