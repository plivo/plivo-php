<?php

namespace Plivo\Util;

use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\RequestInterface;


/**
 * Class signatureValidation
 * @package Plivo\Util
 */
class signatureValidation
{
    /**
     * Return an array without keys with null values
     *
     * @param array $array
     * @return array
     */
    public static function validateSignature($uri, $nonce, $signature, $auth_token='')
    {
      $nonce = utf8_encode($nonce);
      $signature = utf8_encode($signature);
      $auth_token = utf8_encode($auth_token);
      $uri = utf8_encode($uri);
      $port = '';
      $parsed_uri = parse_url($uri);
      $base_url = $parsed_uri['scheme'].'://'.$parsed_uri['host'];
      if (isset($parsed_uri['port'])) {
        $base_url .= ':'.$parsed_uri['port'];
      }
      if (isset($parsed_uri['path'])) {
        $base_url .= $parsed_uri['path'];
      }
      $hmac = hash_hmac('SHA256', $base_url.$nonce, $auth_token, true);
      $authentication_string = base64_encode($hmac);
      return $authentication_string == $signature;
    }

    /**
     * Validate the signature of a request
     *
     * @param string $authToken
     * @param RequestInterface|null $request
     *
     * @return bool
     */
    public static function validateRequest($authToken, RequestInterface $request = null)
    {
        if ($request === null) {
            $request = ServerRequest::fromGlobals();
        }

        $uri = (string) $request->getUri();
        $nonce = $request->getHeaderLine('X-Plivo-Signature-V2-Nonce');
        $signature = $request->getHeaderLine('X-Plivo-Signature-V2');

        return self::validateSignature($uri, $nonce, $signature, $authToken);
    }
}
