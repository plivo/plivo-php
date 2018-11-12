<?php

namespace Plivo\Phlo\ConferenceBridge;

class ConferenceBridge
{
    /**
     * @var
     */
    public $nodeId;
    public $phloId;
    public $baseURL;
    public $client;

    /**
     * MultiPartyCall constructor.
     * @param $nodeId
     */
    public function __construct($nodeId, $phloId, $baseURL, $client)
    {
        $this->nodeId = $nodeId;
        $this->phloId = $phloId;
        $this->baseURL = $baseURL;
        $this->client = $client;
    }

    public function mute($memberAddress)
    {
        return $this->update("mute", $memberAddress);
    }

    public function unmute($memberAddress)
    {
        return $this->update("unmute", $memberAddress);
    }

    public function hangup($memberAddress)
    {
        return $this->update("hangup", $memberAddress);
    }

    public function update($action, $memberAddress = null, $triggerSource = null, $to = null, $role = null)
    {
        $uri = $this->baseURL . $this->phloId . "/conference_bridge/" . $this->nodeId . "/members/" . $memberAddress;

        $methodName = "conference_bridge_$action";

        return $this->client->$methodName(
            $uri,
            [
                "action" => $action
            ]
        );
    }

}