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
 * Class BaseClient
 *
 * @package Plivo
 */
class BaseClient
{
    /**
     * @const BASE API URL
     */
    const BASE_API_URL = 'https://api.plivo.com/';
    /**
     * @const Default timeout for request
     */
    const DEFAULT_REQUEST_TIMEOUT = 5;

    /**
     * @var int|null Request timeout
     */
    protected $timeout = null;
    /**
     * @var PlivoHttpClientInterface
     */
    protected $httpClientHandler;
    /**
     * @var BasicAuth
     */
    protected $basicAuth;
    /**
     * @var int Number of requests made
     */
    public static $requestCount = 0;

    /**
     * Instantiates a new BaseClient object.
     *
     * @param string|null $authId
     * @param string|null $authToken
     * @param null $proxyHost
     * @param null $proxyPort
     * @param null $proxyUsername
     * @param null $proxyPassword
     * @internal param null $proxyOptions
     */
    public function __construct(
        $authId = null,
        $authToken = null,
        $proxyHost = null,
        $proxyPort = null,
        $proxyUsername = null,
        $proxyPassword = null)
    {
        $this->basicAuth = new BasicAuth($authId, $authToken);
        $this->httpClientHandler =
            new PlivoGuzzleHttpClient(
                null,
                $this->basicAuth,
                $proxyHost,
                $proxyPort,
                $proxyUsername,
                $proxyPassword);
    }

    /**
     * @param $name
     * @return mixed
     * @throws PlivoRestException
     */
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        throw new PlivoRestException('Unknown resource ' . $name);
    }

    /**
     * Sets the HTTP client handler.
     *
     * @param PlivoHttpClientInterface $httpClientHandler
     */
    public function setHttpClientHandler(PlivoHttpClientInterface $httpClientHandler)
    {
        $this->httpClientHandler = $httpClientHandler;
    }

    /**
     * Set default timeout for all the requests
     *
     * @param int $timeout
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * Returns the HTTP client handler.
     *
     * @return PlivoHttpClientInterface
     */
    public function getHttpClientHandler()
    {
        return $this->httpClientHandler;
    }

    /**
     * Returns the Authentication Id
     *
     * @return string
     */
    public function getAuthId()
    {
        return $this->basicAuth->getAuthId();
    }

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

        $requestBody = json_encode($request->getParams(), JSON_FORCE_OBJECT);

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
     * Fetch method
     * @param string $uri
     * @param array $params
     * @return PlivoResponse
     */
    public function fetch($uri, $params)
    {
        $request =
            new PlivoRequest(
                'GET', $uri, ArrayOperations::removeNull($params));
        return $this->sendRequest($request);
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

    /**
     * @param $uri
     * @param $params
     * @return PlivoResponse
     */
    public function updateNode($uri, $params)
    {
        $request =
            new PlivoRequest(
                'POST', $uri, ArrayOperations::removeNull($params));
        return $this->sendRequest($request, $uri);
    }

    /**
     * @param $uri
     * @param $params
     * @param null $headers
     * @return PlivoResponse
     */
    public function getPhlorunnerApis($uri, $params, $headers = null)
    {
        $request =
            new PlivoRequest(
                'POST', $uri, ArrayOperations::removeNull($params));
        $request->setHeaders($headers);
        return $this->sendRequest($request, $uri);
    }

    /**
     * Fetch method
     * @param string $uri
     * @param array $params
     * @return PlivoResponse
     */
    public function getPhlorunner($uri, $params)
    {
        $request =
            new PlivoRequest(
                'GET', $uri, ArrayOperations::removeNull($params));
        return $this->sendRequest($request, $uri);
    }

    /**
     * Delete method
     * @param string $uri
     * @param array $params
     * @return PlivoResponse
     */
    public function delete($uri, $params)
    {
        $request =
            new PlivoRequest(
                'DELETE', $uri, ArrayOperations::removeNull($params));

        return $this->sendRequest($request);
    }
}
