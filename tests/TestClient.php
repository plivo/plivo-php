<?php

namespace Plivo\Tests;


use GuzzleHttp\Client;


use Plivo\Authentication\BasicAuth;
use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\HttpClients\PlivoHttpClientInterface;


/**
 * Class TestClient
 * @package Plivo\Tests
 *
 * @method null mock(PlivoResponse $response)
 */
class TestClient implements PlivoHttpClientInterface
{
    /**
     * @var array
     */
    private $requests = [];
    /**
     * @var null
     */
    private $response = null;

    /**
     * @var Client
     */
    protected $guzzleClient;
    /**
     * @var string
     */
    protected $authId;
    /**
     * @var string
     */
    protected $authToken;

    /**
     * @param \GuzzleHttp\Client|null The Guzzle client.
     * @param \Plivo\Authentication\BasicAuth|null Authentication details.
     * @param \GuzzleHttp\Client|null Handler.
     */
    public function __construct(Client $guzzleClient = null, BasicAuth $basicAuth = null)
    {
        if (!is_null($basicAuth)) {
            $this->authId = $basicAuth->getAuthId();
            $this->authToken = $basicAuth->getAuthToken();
        }
        $this->guzzleClient = $guzzleClient ?: new Client();

    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments) {
        $method = $name.'Response';
        if (method_exists($this, $method)) {
            return call_user_func_array([$this, $method], $arguments);
        }
    }

    /**
     * @param string $url
     * @param string $method
     * @param string $body
     * @param array $headers
     * @param null $timeout
     * @param mixed $request
     * @return null|PlivoResponse
     */
    public function send_request($url, $method, $body, $headers = [], $timeout = null, $request)
    {
        //$headers["Authorization"] = "Basic " . base64_encode("$this->authId:$this->authToken");

        $request->setHeaders($headers);

        array_push($this->requests, $request);

        if ($this->response == null) {
            return new PlivoResponse(null, 404, null);
        } else {
            return $this->response;
        }
    }

    /**
     * @return mixed
     */
    public function lastRequest()
    {
        return $this->requests[count($this->requests)-1];
    }

    /**
     * @param $response PlivoResponse
     */
    protected function mockResponse($response) {
        $this->response = $response;
    }

    /**
     * @param $request PlivoRequest
     */
    public function assertRequest($request) {
        if ($this->hasRequest($request)) {
            return;
        }

        $message = "Failed asserting that the following request exists: \n";
        $message .= ' - ' . $this->printRequest($request);
        $message .= "\n" . str_repeat('-', 3) . "\n";
        $message .= "Candidate Requests:\n";
        foreach ($this->requests as $candidate) {
            $message .= ' + ' . $this->printRequest($candidate) . "\n";
        }

        throw new \PHPUnit_Framework_ExpectationFailedException($message);
    }

    /**
     * @param PlivoRequest $request
     * @return bool
     */
    public function hasRequest($request) {
        for ($i = 0; $i < count($this->requests); $i++) {
            $c = $this->requests[$i];
            if (strtolower($request->method) === strtolower($c->method) &&
                $request->endpoint === $c->endpoint &&
                $request->params === $c->params &&
                $request->headers === $c->headers) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $request
     * @return string
     */
    protected function printRequest($request) {
        $url = $request->endpoint;
        if (($request->method !== 'POST') && (count($request->params) !== 0)) {
            $url .= '?' . http_build_query($request->params);
        }
        $data = count($request->postParams) !== 0
            ? '-d ' . json_encode($request->params)
            : '';
        return implode(' ', [strtoupper($request->method), $url, $data]);
    }
}