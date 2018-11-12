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
        return $this->update("call", null, "919833277189", "919833362398", "agent");

    }

    public function coldTransfer($phoneNumber)
    {
        return $this->update("cold_transfer", $phoneNumber, "919833277189", "919833362398", "agent");

    }

    public function warmTransfer($phoneNumber)
    {
        return $this->update("warm_transfer", $phoneNumber, "919833277189", "919833362398", "agent");

    }

    public function hold($phoneNumber)
    {

        return $this->update("hold", $phoneNumber);

    }

    public function unhold($phoneNumber)
    {
        return $this->update("unhold", $phoneNumber);

    }

    public function hangup($phoneNumber)
    {
        return $this->update("hangup", $phoneNumber);

//        return $this->client->multiPartyHangup(
//            $this->baseURL . $this->phloId . "/multi_party_call/" . $this->nodeId . "/members/" . $phoneNumber,
//            [
//                "action" => "hangup"
//            ]
//        );
//
//        return $response;
    }

    public function resumeCall($phoneNumber = null)
    {
        return $this->update("resume_call", $phoneNumber);


//        return $this->client->multiPartyResumeCall(
//            $this->baseURL . $this->phloId . "/multi_party_call/" . $this->nodeId,
//            [
//                "trigger_source" => "919833277189",
//                "to" => "919833362398",
//                "role" => "agent",
//                "action" => "resume_call"
//            ]
//        );
//
//        return $response;
    }

    public function abortTransfer($phoneNumber)
    {
        return $this->update("abort_transfer", $phoneNumber);


//        return $this->client->multiPartyAbortTransfer(
//            $this->baseURL . $this->phloId . "/multi_party_call/" . $this->nodeId . "/members/" . $phoneNumber,
//            [
//                "action" => "abort_transfer"
//            ]
//        );
//
//        return $response;
    }

    public function voicemailDrop($phoneNumber)
    {
        return $this->update("voicemail_drop", $phoneNumber);


//        return $this->client->multiPartyVoicemailDrop(
//            $this->baseURL . $this->phloId . "/multi_party_call/" . $this->nodeId . "/members/" . $phoneNumber,
//            [
//                "action" => "voicemail_drop"
//            ]
//        );
//
//        return $response;
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

        return $this->client->$methodName(
            $uri,
            [
                "action" => $action,
                "trigger_source" => $triggerSource,
                "to" => $to,
                "role" => $role
            ]
        );
    }
}