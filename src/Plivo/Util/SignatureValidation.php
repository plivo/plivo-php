<?php

namespace Plivo\Util;


/**
 * Class SignatureValidation
 * @package Plivo\Util
 */
class SignatureValidation
{
    /**
     * Validates the signature of a request made by Plivo
     *
     * @param string $uri
     * @param string $nonce
     * @param string $signature
     * @param string $authToken
     *
     * @return bool true if the signature is valid, false otherwise
     */
    public static function validateSignature($uri, $nonce, $signature, $authToken)
    {
        $parsedUri = parse_url($uri);
        $baseUrl = $parsedUri['scheme'].'://'.$parsedUri['host'];
        if (isset($parsedUri['port'])) {
            $baseUrl .= ':'.$parsedUri['port'];
        }
        if (isset($parsedUri['path'])) {
            $baseUrl .= $parsedUri['path'];
        }

        $hmac = hash_hmac('SHA256', $baseUrl.$nonce, $authToken, true);

        return hash_equals($hmac, (string) base64_decode($signature));
    }
}
