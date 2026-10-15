<?php


namespace Plivo\Util;

use Plivo\Exceptions\PlivoValidationException;

class v3SignatureValidation
{

    private static function stringifyParams($params)
    {
        foreach ($params as $key => $value)
        {
            $params[$key] = strval($value);
        }
        return $params;
    }

    private static function getMapFromQuery($queryString)
    {
        $queryMap = array();
        if ($queryString == null) {
            return $queryMap;
        }
        $queryArray = explode("&", $queryString);
        foreach ($queryArray as $param)
        {
            $keyValue = explode("=", $param);
            $key = $keyValue[0];
            $value = $keyValue[1];
            if (array_key_exists($key, $queryMap))
            {
                array_push($queryMap[$key], $value);
            }
            else
            {
                $queryMap[$key] = array($value);
            }
        }
        return $queryMap;
    }

    private static function getSortedQueryString($queryMap)
    {
        $queryString = array();
        ksort($queryMap, SORT_NATURAL);
        foreach ($queryMap as $key => $value)
        {
            if (gettype($value) === "array")
            {
                sort($value, SORT_NATURAL);
                foreach ($value as $val)
                {
                    array_push($queryString, strval($key)."=".strval($val));
                }
            }
            else
            {
                array_push($queryString, strval($key)."=".strval($value));
            }
        }
        return implode("&", $queryString);
    }

    private static function getSortedParamsString($params)
    {
        $keys = array_keys($params);
        sort($keys, SORT_NATURAL);
        $paramsString = array();

        foreach ($keys as $key)
        {
            $value = $params[$key];
            if (gettype($value) === "array")
            {
                $value = sort($value, SORT_NATURAL);
                foreach ($value as $val)
                {
                    array_push($paramsString, strval($key).strval($val));
                }
            }
            else
            {
                array_push($paramsString, strval($key).strval($value));
            }
        }
        return implode("", $paramsString);
    }

    private static function constructGetUrl($uri, $params, $emptyPostParams=true)
    {
        $parsedURI = parse_url($uri);
        $baseURL = $parsedURI['scheme'].'://'.$parsedURI['host'];
        if (isset($parsedURI['port'])) {
            $baseURL .= ':'.$parsedURI['port'];
        }
        if (isset($parsedURI['path'])) {
            $baseURL .= $parsedURI['path'];
        }
        if (isset($parsedURI['query'])) {
            $queryString = $parsedURI['query'];
            $params = array_merge_recursive($params, self::getMapFromQuery($queryString));
        }
        $queryParams = self::getSortedQueryString($params);
        if (strlen($queryParams) > 0 or !$emptyPostParams)
        {
            $baseURL .= '?'.$queryParams;
        }
        if (strlen($queryParams) > 0 and !$emptyPostParams)
        {
            $baseURL .= '.';
        }
        return $baseURL;
    }

    private static function constructPostUrl($uri, $params)
    {

        $baseURL = self::constructGetUrl($uri, array(),count($params) > 0 ? false : true);
        return $baseURL.self::getSortedParamsString($params);
    }

    private static function getSignatureV3($authToken, $baseURL, $nonce)
    {
        $baseURL = utf8_encode($baseURL.".".$nonce);
        $hmac = hash_hmac('SHA256', $baseURL, $authToken, true);
        return base64_encode($hmac);
    }

    /**
     * Return a recording instance
     *
     * @param string $method
     * @param string $uri
     * @param string $nonce
     * @param string $auth_token
     * @param string $v3_signature
     * @param array $params
     * @return boolean
     * @throws PlivoValidationException
     */
    public static function validateV3Signature($method, $uri, $nonce, $auth_token, $v3_signature, $params=[])
    {
        $auth_token = utf8_encode($auth_token);
        $v3_signature = utf8_encode($v3_signature);
        $signature = self::computeV3Signature($method, $uri, $nonce, $auth_token, $params);
        return in_array($signature, explode(',', $v3_signature));
    }

    private static function computeV3Signature($method, $uri, $nonce, $key, $params)
    {
        $nonce = utf8_encode($nonce);
        $uri = utf8_encode($uri);
        $params = self::stringifyParams($params);
        if ($method == 'GET')
        {
            $base_url = self::constructGetUrl($uri, $params);
        }
        elseif ($method == 'POST')
        {
            $base_url = self::constructPostUrl($uri, $params);
        }
        else
        {
            throw new PlivoValidationException('method not allowed for signature validation');
        }
        return self::getSignatureV3($key, $base_url, $nonce);
    }

    /**
     * Derive the raw 32-byte webhook signing key for a scoped API token (HKDF-SHA256, RFC 5869)
     *
     * @param string $scoped_token
     * @return string binary key
     */
    public static function deriveSigningKey($scoped_token)
    {
        $prk = hash_hmac('sha256', $scoped_token, 'plivo-scoped-token-v1', true);
        return hash_hmac('sha256', "plivo-webhook-signing-v1\x01", $prk, true);
    }

    /**
     * Validate X-Plivo-Signature-V3 against one key or a list of keys; passes if any key matches.
     * Scoped tokens (46 chars, "PLV" prefix) are HKDF-derived, any other key is used as an auth token.
     *
     * @param string $method
     * @param string $uri
     * @param string $nonce
     * @param string|string[] $keys
     * @param string $v3_signature
     * @param array $params
     * @return boolean
     * @throws PlivoValidationException
     */
    public static function validateV3SignatureScoped($method, $uri, $nonce, $keys, $v3_signature, $params=[])
    {
        $candidates = array_map('trim', explode(',', $v3_signature));
        $valid = false;
        foreach ((array) $keys as $key)
        {
            if ($key === null || $key === '')
            {
                continue;
            }
            $hmacKey = (strlen($key) == 46 && strpos($key, 'PLV') === 0) ? self::deriveSigningKey($key) : utf8_encode($key);
            $signature = self::computeV3Signature($method, $uri, $nonce, $hmacKey, $params);
            foreach ($candidates as $candidate)
            {
                $valid = hash_equals($signature, $candidate) || $valid;
            }
        }
        return $valid;
    }
}
