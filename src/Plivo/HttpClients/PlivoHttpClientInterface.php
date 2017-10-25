<?php

namespace Plivo\HttpClients;


use Plivo\Http\PlivoRequest;

/**
 * Interface PlivoHttpClientInterface
 * @package Plivo\HttpClients
 */
interface PlivoHttpClientInterface
{
    /**
     * Sends a request to the server and returns the raw response.
     *
     * @param string $url     The endpoint to send the request to.
     * @param string $method  The request method.
     * @param string $body    The body of the request.
     * @param array  $headers The request headers.
     * @param int    $timeOut The timeout in seconds for the request.
     * @param PlivoRequest $request The original request
     *
     * @return \Plivo\Http\PlivoResponse Raw response from the server.
     *
     * @throws \Plivo\Exceptions\PlivoRestException
     */
    public function send_request($url, $method, $body, $headers, $timeOut, $request);
}