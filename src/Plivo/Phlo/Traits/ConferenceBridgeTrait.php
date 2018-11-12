<?php

namespace Plivo\Phlo\Traits;

use Plivo\Http\PlivoRequest;
use Plivo\Util\ArrayOperations;

trait ConferenceBridgeTrait
{
    public function conference_bridge_mute($uri, $params)
    {
        $request =
            new PlivoRequest(
                'POST', $uri, ArrayOperations::removeNull($params));

        return $this->sendRequest($request, $uri);
    }

    public function conference_bridge_unmute($uri, $params)
    {
        $request =
            new PlivoRequest(
                'POST', $uri, ArrayOperations::removeNull($params));

        return $this->sendRequest($request, $uri);
    }

    public function conference_bridge_hangup($uri, $params)
    {
        $request =
            new PlivoRequest(
                'POST', $uri, ArrayOperations::removeNull($params));

        return $this->sendRequest($request, $uri);
    }
}