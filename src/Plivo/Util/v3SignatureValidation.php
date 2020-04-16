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
        $queryString = $parsedURI['query'];
        $params = array_merge_recursive($params, self::getMapFromQuery($queryString));
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
        $nonce = utf8_encode($nonce);
        $v3_signature = utf8_encode($v3_signature);
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
        $signature = self::getSignatureV3($auth_token, $base_url, $nonce);
        return in_array($signature, explode(',', $v3_signature));
    }
}
