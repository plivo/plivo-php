<?php

namespace Plivo;

use Plivo\Authentication\BasicAuth;
use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\HttpClients\PlivoGuzzleHttpClient;
use Plivo\HttpClients\PlivoHttpClientInterface;
use Plivo\Exceptions\PlivoRestException;
use Plivo\Util\ArrayOperations;

/**
 * Class MessageClient
 *
 * @package Plivo
 */
class MessageClient extends BaseClient
{

    /**
     * Prepares the request for sending to the client handler.
     *
     * @param PlivoRequest $request
     *
     * @return array
     */
    public function prepareRequestMessage(PlivoRequest $request, $fullUrl = null)
    {
        $url = $fullUrl ? $fullUrl : self::BASE_API_URL . $request->getUrl();

        $requestBody = json_encode($request->getParams());

        return [
            $url,
            $request->getMethod(),
            $request->getHeaders(),
            $requestBody,
        ];
    }

    /**
     * @param PlivoRequest $request
     * @param null $url
     * @return PlivoResponse
     * @throws Exceptions\PlivoRequestException
     * @throws PlivoRestException
     */
    public function sendRequest(PlivoRequest $request, $url = null)
    {
        $fullUrl = $url ? $url : null;
        list($url, $method, $headers, $body) =
            $this->prepareRequestMessage($request, $fullUrl);

        $timeout = $this->timeout ?: static::DEFAULT_REQUEST_TIMEOUT;

        $plivoResponse =
            $this->httpClientHandler->send_request(
                $url, $method, $body, $headers, $timeout, $request);

        static::$requestCount++;

        if (!$plivoResponse->ok()) {
            return $plivoResponse;
        }

        return $plivoResponse;
    }

    /**
     * Update method
     * @param string $uri
     * @param array $params
     * @return PlivoResponse
     */
    public function update($uri, $params)
    {
        $request =
            new PlivoRequest(
                'POST', $uri, ArrayOperations::removeNull($params));

        return $this->sendRequest($request);
    }

}
