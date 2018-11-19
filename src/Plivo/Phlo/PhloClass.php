<?php

namespace Plivo\Phlo;

use Plivo\Http\PlivoRequest;
use Plivo\Phlo\MultiPartyCall\MultiPartyCall;
use Plivo\Phlo\ConferenceBridge\ConferenceBridge;
use Plivo\Util\ArrayOperations;

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
    public function __construct($phloId = null, $client = null)
    {
        $this->client = $client;
        $this->phloId = $phloId;
    }

    public function getPhlo($phloId)
    {
        $uri = self::BASE_PHLO_URL . $phloId;
        $request =
            new PlivoRequest(
                'GET', $uri, ArrayOperations::removeNull([]));

        return $this->client->sendRequest($request, $uri);
    }

    public function getNode($phloId, $nodeType, $nodeId)
    {
        $uri = self::BASE_PHLO_URL . $phloId . "/" . $nodeType . "/" . $nodeId;
        $request =
            new PlivoRequest(
                'GET', $uri, ArrayOperations::removeNull([]));

        return $this->client->sendRequest($request, $uri);
    }

    /**
     * @param $nodeId
     * @param $client
     * @return MultiPartyCall
     */
    public function multiPartyCall($nodeId)
    {
        $this->node = new MultiPartyCall($nodeId, $this->phloId, self::BASE_PHLO_URL, $this->client);
        return $this->node;
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