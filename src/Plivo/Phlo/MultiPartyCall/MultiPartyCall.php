<?php

namespace Plivo\Phlo\MultiPartyCall;

use Plivo\Resources\ResponseDelete;

/**
 * Class MultiPartyCall
 * @package Plivo\Phlo\MultiPartyCall
 */
class MultiPartyCall
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

    public function call($phoneNumber = null)
    {
        $response = $this->update("call", null, "919833277189", "919833362398", "agent");

        return $response;
    }

    public function coldTransfer($phoneNumber)
    {
        $response = $this->update("cold_transfer", $phoneNumber, "919833277189", "919833362398", "agent");

        return $response;
    }

    public function warmTransfer($phoneNumber)
    {
        $response = $this->update("warm_transfer", $phoneNumber, "919833277189", "919833362398", "agent");

        return $response;
    }

    public function hold($phoneNumber)
    {

        $response = $this->update("hold", $phoneNumber);

        return $response;
    }

    public function unhold($phoneNumber)
    {
        $response = $this->update("unhold", $phoneNumber);

        return $response;
    }

    public function hangup($phoneNumber)
    {
        $response = $this->update("hangup", $phoneNumber);

        return $response;
    }

    public function resumeCall($phoneNumber = null)
    {
        $response = $this->update("resume_call", $phoneNumber);

        return $response;
    }

    public function abortTransfer($phoneNumber)
    {
        $response = $this->update("abort_transfer", $phoneNumber);

        return $response;
    }

    public function voicemailDrop($phoneNumber)
    {
        $response = $this->update("voicemail_drop", $phoneNumber);

        return $response;
    }

    public function update($action, $phoneNumber = null, $triggerSource = null, $to = null, $role = null)
    {
        $actionsWithMembersInURI = ["cold_transfer", "warm_transfer", "hold", "unhold", "hangup", "abort_transfer", "voicemail_drop"];
        $actionsWithoutMembersInURI = ["call", "resume_call"];

        if(in_array($action, $actionsWithoutMembersInURI)) {
            $uri = $this->baseURL . $this->phloId . "/multi_party_call/" . $this->nodeId;
        } else if(in_array($action, $actionsWithMembersInURI)) {
            $uri = $this->baseURL . $this->phloId . "/multi_party_call/" . $this->nodeId . "/members/" . $phoneNumber;
        } else {
            $uri = null;
        }

        $methodName = "multi_party_$action";

        $response = $this->client->$methodName(
            $uri,
            [
                "action" => $action,
                "trigger_source" => $triggerSource,
                "to" => $to,
                "role" => $role
            ]
        );

        return $response;
    }
}