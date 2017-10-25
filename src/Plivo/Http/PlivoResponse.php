<?php

namespace Plivo\Http;



use Plivo\Exceptions\PlivoResponseException;
use Plivo\Exceptions\PlivoRestException;


/**
 * Class PlivoResponse
 * @package Plivo\Http
 */
class PlivoResponse
{
    /**
     * @var int The HTTP status code response from Api
     */
    protected $statusCode;

    /**
     * @var array The headers returned from Api.
     */
    protected $headers;

    /**
     * @var string The raw body of the response from Api.
     */
    protected $content;

    /**
     * @var array The decoded body of the Api response.
     */
    protected $decodedContent = [];

    /**
     * @var PlivoRequest The original request that returned this response.
     */
    protected $request;

    /**
     * @var PlivoRestException The exception thrown by this request.
     */
    protected $thrownException;

    /**
     * Creates a new PlivoResponse entity.
     *
     * @param PlivoRequest    $request The request that created this response
     * @param int|null        $httpStatusCode The status code of the response
     * @param string|null     $content The raw content of the response
     * @param array|null      $headers The headers of the response
     */
    public function __construct(
        PlivoRequest $request = null,
        $httpStatusCode = null,
        $content = null,
        array $headers = [])
    {
        $this->request = $request;
        $this->content = $content;
        $this->statusCode = $httpStatusCode;
        $this->headers = $headers;

        $this->decodeContent();
    }

    /**
     * Instantiates an exception to be thrown later.
     */
    public function makeException()
    {
        // make exception based on the status code
        $this->thrownException =
            new PlivoResponseException(
                null, null, null,
                $this->decodedContent, $this->statusCode);

        echo $this->thrownException->getMessage();
    }


    /**
     * Decodes the JSON and then checks if the response is 2xx,
     * accordingly creates an exception
     */
    public function decodeContent()
    {
        $this->decodedContent =
            json_decode($this->content, true)?
                :["error"=>$this->content];

        if (!$this->ok()) {
            $this->makeException();
        }
    }

    /**
     * Converts the contents of the response to JSON object
     * @return mixed
     */
    public function getContent()
    {
        return $this->decodedContent;
    }

    /**
     * Returns the status code from the response
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Returns the headers from the response
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Returns the thrown exception for the response
     * @return mixed
     */
    public function getThrownException()
    {
        return $this->thrownException;
    }

    /**
     * Returns true if api request succeeded.
     *
     * @return boolean
     */
    public function ok()
    {
        return $this->getStatusCode() < 400;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return '[PlivoResponse] HTTP ' . $this->getStatusCode() . ' ' . $this->content;
    }
}