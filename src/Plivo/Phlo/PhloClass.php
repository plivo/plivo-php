<?php

namespace Plivo\Phlo;

use Illuminate\Http\Request;
use Plivo\Phlo\MultiPartyCall\MultiPartyCall;

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
    public $phloId;
    public $node;


    /**
     * Phlo constructor.
     * @param $phloId
     */
    public function __construct($phloId)
    {
        $this->phloId = $phloId;
    }

    public function multiPartyCall($nodeId, $client)
    {
        $this->node = new MultiPartyCall($nodeId, $this->phloId, self::BASE_PHLO_URL, $client);
        return $this->node;
    }

    public function node($nodeType, $nodeId, $client) {
        if($nodeType === "multi_party_call") {
            $this->multiPartyCall($nodeId, $client);
            return $this->node;
        } else if($nodeType === "conference_bridge") {
            return $this->node;
        }
    }
}