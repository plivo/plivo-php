<?php

namespace Plivo\Util;


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

      $parsed_uri = parse_url($uri);

      $base_url = $parsed_uri['scheme'].'://'.$parsed_uri['host'];
      if (isset($parsed_uri['path']))
        $base_url = $parsed_uri['scheme'].'://'.$parsed_uri['host'].''.$parsed_uri['path'];

      $hmac = hash_hmac('SHA256', $base_url.$nonce, $auth_token, true);
      $authentication_string = base64_encode($hmac);
      return $authentication_string == $signature;
    }
}
