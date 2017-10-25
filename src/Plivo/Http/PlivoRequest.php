<?php

namespace Plivo\Http;
use Plivo\Exceptions\PlivoRequestException;
use Plivo\Exceptions\PlivoRestException;
use Plivo\Version;

/**
 * Class Request
 *
 * @package Plivo
 */
class PlivoRequest
{
    /**
     * @var string The HTTP method for this request.
     */
    protected $method;

    /**
     * @var string The api endpoint for this request.
     */
    protected $endpoint;

    /**
     * @var array The headers to send with this request.
     */
    protected $headers = [];

    /**
     * @var array The parameters to send with this request.
     */
    protected $params = [];

    /**
     * @var string api version to use for this request.
     */
    protected $apiVersion;

    protected $phpVersion;

    /**
     * Creates a new Request instance.
     *
     * @param string|null             $method
     * @param string|null             $endpoint
     * @param array|null              $params
     * @param array|null              $headers
     * @param string|null             $apiVersion
     */
    public function __construct(
        $method = null,
        $endpoint = null,
        array $params = [],
        array $headers = [],
        $apiVersion = null)
    {
        $this->setMethod($method);
        $this->setEndpoint($endpoint);
        $this->setParams($params);
        $this->apiVersion = $apiVersion ?: Version::DEFAULT_API_VERSION;
        $this->phpVersion = phpversion();
    }


    /**
     * Lazy getter
     * @param string $name
     * @return mixed
     * @throws PlivoRestException
     */
    function __get($name)
    {
        $method = "get".ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        throw new PlivoRestException($name . ' not found');
    }

    /**
     * Set the HTTP method for this request.
     *
     * @param string
     */
    public function setMethod($method)
    {
        $this->method = strtoupper($method);
    }

    /**
     * Return the HTTP method for this request.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Validate that the HTTP method is set and
     * supported by the api
     *
     * @throws PlivoRestException
     */
    public function validateMethod()
    {
        if (!$this->method) {
            throw new PlivoRequestException('HTTP method not specified.');
        }

        if (!in_array($this->method, ['GET', 'POST', 'DELETE'])) {
            throw new PlivoRequestException('Invalid HTTP method specified.');
        }
    }

    /**
     * Set the endpoint for this request.
     *
     * @param string
     *
     * @return PlivoRequest
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * Return the endpoint for this request.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Generate and return the headers for this request.
     *
     * @return array
     */
    public function getHeaders()
    {
        $headers = static::getDefaultHeaders();

        return array_merge($this->headers, $headers);
    }

    /**
     * Set the headers for this request.
     *
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = array_merge($this->headers, $headers);
    }

    /**
     * Returns the body of the request as URL-encoded.
     *
     * @return mixed
     */
    public function getUrlEncodedBody()
    {
        $params = $this->getPostParams();

        return http_build_query($params, null, '&');
    }

    /**
     * Set the params for this request.
     *
     * @param array $params
     *
     * @return PlivoRequest
     *
     * @throws PlivoRestException
     */
    public function setParams(array $params = [])
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }

    /**
     * Generate and return the params for this request.
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Only return params on POST requests.
     *
     * @return array
     */
    public function getPostParams()
    {
        if ($this->getMethod() === 'POST') {
            return $this->getParams();
        }

        return [];
    }

    /**
     * The api version used for this request.
     *
     * @return string
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * Generate and return the URL for this request.
     *
     * @return string
     */
    public function getUrl()
    {
        $this->validateMethod();

        $apiVersion = $this->apiVersion . '/';
        $endpoint = $this->getEndpoint();

        $url = $apiVersion . $endpoint;

        if ($this->getMethod() !== 'POST') {
            $params = $this->getParams();
            $url = static::appendParamsToUrl($url, $params);
        }

        return $url;
    }

    /**
     * Append the parameters to the url for GET request
     * @param string $url The url to append the params to
     * @param array $params The parameters' array
     * @return string
     */
    public static function appendParamsToUrl($url, $params)
    {
        if (empty($params)) {
            return $url;
        }

        $getParams =  http_build_query($params, null, '&');

        return $url . '?' . $getParams;
    }

    /**
     * Return the default headers that every request should use.
     *
     * @return array
     */
    public function getDefaultHeaders()
    {
        return [
            'User-Agent' => 'plivo-php/' . implode('.',
                    [Version::MAJOR, Version::MINOR, Version::PATCH])
                    . ' (PHP ' . $this->phpVersion . ')',
            'Accept-Encoding' => '*',
            'Content-type' => 'application/json'
        ];
    }
}
