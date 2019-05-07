<?php

namespace Plivo\HttpClients;

use GuzzleHttp\Client;
use InvalidArgumentException;
use Exception;
use Plivo\Authentication\BasicAuth;

/**
 * Class HttpClientsFactory
 * @package Plivo\HttpClients
 */
class HttpClientsFactory
{
    /**
     * HttpClientsFactory constructor.
     */
    private function __construct()
    {
    }

    /**
     * HTTP client generation.
     *
     * @param PlivoHttpClientInterface|Client|string|null $handler
     * @param \Plivo\Authentication\BasicAuth $auth
     *
     * @throws Exception                If the cURL extension or the Guzzle client aren't available (if required).
     * @throws InvalidArgumentException If the http client handler isn't "curl", "guzzle", or an instance of Plivo\HttpClients\PlivoHttpClientInterface.
     *
     * @return PlivoHttpClientInterface
     */
    public static function createHttpClient($handler, $auth)
    {
        if (!$handler) {
            return self::detectDefaultClient($auth);
        }

        if ($handler instanceof PlivoHttpClientInterface) {
            return $handler;
        }

        if ('curl' === $handler) {
            if (!extension_loaded('curl')) {
                throw new Exception('The cURL extension must be loaded in order to use the "curl" handler.');
            }

            return new PlivoGuzzleHttpClient(null, $auth);
        }

        if ('guzzle' === $handler && !class_exists('GuzzleHttp\Client')) {
            throw new Exception(
                'The Guzzle HTTP client must be included in order to use the "guzzle" handler.');
        }

        if ($handler instanceof Client) {
            return new PlivoGuzzleHttpClient($handler, $auth);
        }
        if ('guzzle' === $handler) {
            return new PlivoGuzzleHttpClient(null ,$auth);
        }

        throw new InvalidArgumentException('The http client handler must be set to "curl", "guzzle", be an instance of GuzzleHttp\Client or an instance of Plivo\HttpClients\PlivoHttpClientInterface');
    }


    /**
     * Detect and return the default http client
     * TODO implement curl client as well
     * @param BasicAuth $auth The authentication credentials
     * @return PlivoGuzzleHttpClient
     */
    private static function detectDefaultClient($auth)
    {
        if (class_exists('GuzzleHttp\Client')) {
            return new PlivoGuzzleHttpClient(null, $auth);
        }

        if (extension_loaded('curl')) {
            return new PlivoGuzzleHttpClient(null, $auth);
        }

        return new PlivoGuzzleHttpClient(null, $auth);
    }
}