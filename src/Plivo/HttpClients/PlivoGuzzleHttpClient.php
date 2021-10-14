<?php

namespace Plivo\HttpClients;

use Plivo\Authentication\BasicAuth;
use Plivo\Exceptions\PlivoRequestException;


use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


/**
 * Class PlivoGuzzleHttpClient
 * @package Plivo\HttpClients
 */
class PlivoGuzzleHttpClient implements PlivoHttpClientInterface
{
    /**
     * @var \GuzzleHttp\Client The Guzzle client.
     */
    protected $guzzleClient;
    /**
     * @var string The authentication ID
     */
    protected $authId;
    /**
     * @var string The authentication token
     */
    protected $authToken;

    /**
     * @param Client|null $guzzleClient
     * @param BasicAuth|null $basicAuth
     * @param string|null $proxyHost
     * @param string|null $proxyPort
     * @param string|null $proxyUsername
     * @param string|null $proxyPassword
     * @internal param Client|null $The Guzzle client.
     * @internal param null|BasicAuth $Authentication details.
     * @internal param Client|null $Handler .
     */
    public function __construct(
        Client $guzzleClient = null,
        BasicAuth $basicAuth = null,
        $proxyHost = null,
        $proxyPort = null,
        $proxyUsername = null,
        $proxyPassword = null)
    {
        if (!is_null($basicAuth)) {
            $this->authId = $basicAuth->getAuthId();
            $this->authToken = $basicAuth->getAuthToken();
        }

        if ($proxyHost) {
            if ($proxyUsername) {
                $this->guzzleClient = $guzzleClient ?:
                    new Client(
                        ['proxy' =>
                            explode('://', $proxyHost)[0].
                            '://'.
                            $proxyUsername.
                            ':'.
                            $proxyPassword.
                            '@'.
                            explode('://', $proxyHost)[1].
                            ':'.
                            $proxyPort]);
            } else {
                $this->guzzleClient = $guzzleClient ?:
                    new Client(
                        ['proxy' =>
                            $proxyHost.
                            ':'.
                            $proxyPort]);
            }
        } else {
            $this->guzzleClient = $guzzleClient ?: new Client();
        }


    }

    /**
     * Actually sends the request to the http client
     * @param string $url The URL to send the request to
     * @param string $method The request method used
     * @param string $body The request body containing POST data
     * @param array $headers The request headers
     * @param int $timeOut Timeout
     * @param PlivoRequest|null $request The original PlivoRequest object
     * @return PlivoResponse
     * @throws PlivoRequestException
     */
    public function send_request($url, $method, $body, $headers, $timeOut, $request)
    {
        $headers["Authorization"] = "Basic " . base64_encode("$this->authId:$this->authToken");
        $request->setHeaders($headers);
        $options =[];
        $requestBody = json_encode($request->getParams());
        if(empty($request->getParams())){
            $requestBody = json_encode($request->getParams(), JSON_FORCE_OBJECT);
        }
        if (array_key_exists("isCallInsightsRequest", $request->getParams())) {
            unset($request->getParams()['isCallInsightsRequest']);
            $requestBody = $requestBody;
        }
        if(isset($body['multipart'])){
            $requestBody = json_encode($request->getParams(), JSON_FORCE_OBJECT);
            unset($headers['Content-type']);
            $options = [
                'http_errors' => false,
                'headers' => $headers,
                'timeout' => $timeOut,
                'connect_timeout' => 160,
                'multipart' => $body['multipart']
            ];
        } else{
            $options = [
                'http_errors' => false,
                'headers' => $headers,
                'timeout' => $timeOut,
                'connect_timeout' => 60,
            ];
        }
        if($method != "GET"){
            $options['body'] = $requestBody;
        }
        try {
            $rawResponse = $this->guzzleClient->request($method, $url, $options);
        } catch (RequestException $e) {
            throw new PlivoRequestException($e->getMessage());
        }
        $rawHeaders = $rawResponse->getHeaders();
        $rawBody = $rawResponse->getBody()->getContents();
        $httpStatusCode = $rawResponse->getStatusCode();

        return new PlivoResponse($request, $httpStatusCode, $rawBody, $rawHeaders);
    }
}