<?php

namespace Plivo\Phlo\Traits;

use Plivo\Http\PlivoRequest;
use Plivo\Util\ArrayOperations;

trait MultiPartyBaseClientTrait
{
    public function multi_party_call($uri, $params)
    {
        $request =
            new PlivoRequest(
                'POST', $uri, ArrayOperations::removeNull($params));

        return $this->sendRequest($request, $uri);
    }

    public function multi_party_cold_transfer($uri, $params)
    {
        $request =
            new PlivoRequest(
                'POST', $uri, ArrayOperations::removeNull($params));

        return $this->sendRequest($request, $uri);
    }

    public function multi_party_warm_transfer($uri, $params)
    {
        $request =
            new PlivoRequest(
                'POST', $uri, ArrayOperations::removeNull($params));

        return $this->sendRequest($request, $uri);
    }

    public function multi_party_hold($uri, $params)
    {
        $request =
            new PlivoRequest(
                'POST', $uri, ArrayOperations::removeNull($params));

        return $this->sendRequest($request, $uri);
    }

    public function multi_party_unhold($uri, $params)
    {
        $request =
            new PlivoRequest(
                'POST', $uri, ArrayOperations::removeNull($params));

        return $this->sendRequest($request, $uri);
    }

    public function multi_party_hangup($uri, $params)
    {
        $request =
            new PlivoRequest(
                'POST', $uri, ArrayOperations::removeNull($params));

        return $this->sendRequest($request, $uri);
    }

    public function multi_party_resume_call($uri, $params)
    {
        $request =
            new PlivoRequest(
                'POST', $uri, ArrayOperations::removeNull($params));

        return $this->sendRequest($request, $uri);
    }

    public function multi_party_abort_transfer($uri, $params)
    {
        $request =
            new PlivoRequest(
                'POST', $uri, ArrayOperations::removeNull($params));

        return $this->sendRequest($request, $uri);
    }

    public function multi_party_voicemail_drop($uri, $params)
    {
        $request =
            new PlivoRequest(
                'POST', $uri, ArrayOperations::removeNull($params));

        return $this->sendRequest($request, $uri);
    }
}