<?php

namespace Plivo\Exceptions;



use Throwable;

/**
 * Class PlivoResponseException
 * @package Plivo\Exceptions
 */
class PlivoResponseException extends PlivoRestException
{
    /**
     * @var array Decoded response
     */
    protected $responseData;
    /**
     * @var integer http status code
     */
    protected $statusCode;

    /**
     * PlivoResponseException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     * @param array $responseData
     * @param integer $statusCode
     */
    public function __construct(?string $message, ?int $code, ?Throwable $previous, $responseData, $statusCode)
    {
        $this->responseData = $responseData;
        $this->statusCode = $statusCode;
        parent::__construct($message, $code, $this->getException($this->getErrorMessage()));
    }

    /**
     * Retrieves the error message from the response
     * @return null|string
     */
    public function getErrorMessage()
    {
        if (array_key_exists('error', $this->responseData?: [])) {
            if (is_string($this->responseData['error'])) {
                return json_encode($this->responseData['error']);
            } elseif(array_key_exists('error', $this->responseData['error'])) {
                return json_encode($this->responseData['error']['error']);
            } else {
                return json_encode($this->responseData['error']);
            }
        } else {
            return null;
        }
    }

    /**
     * Returns an exceptions with a message based on the status code
     * @param string $message
     * @return PlivoAuthenticationException|PlivoNotFoundException|PlivoRequestException|PlivoRestException|PlivoServerException|PlivoValidationException
     */
    public function getException($message)
    {
        // make exception based on the status code
        switch ($this->statusCode) {
            case 400:
                return
                    $message?
                        new PlivoValidationException($message):
                        new PlivoValidationException(
                            "A parameter is missing or ".
                            "is invalid while accessing resource");
                break;
            case 401:
                return
                    $message?
                        new PlivoAuthenticationException($message):
                        new PlivoAuthenticationException(
                        "Failed to authenticate while accessing resource");
                break;
            case 404:
                return
                    $message?
                        new PlivoNotFoundException($message):
                        new PlivoNotFoundException(
                        "Failed to authenticate while accessing resource");
                break;
            case 405:
                return
                    $message?
                        new PlivoRequestException($message):
                        new PlivoRequestException(
                        "HTTP method used is not allowed to access resource");
                break;
            case 500:
                return
                    $message?
                        new PlivoServerException($message):
                        new PlivoServerException(
                        "A server error occurred while accessing resource");
                break;
            default:
                return new PlivoRestException(json_encode($this->responseData));
        }

    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}