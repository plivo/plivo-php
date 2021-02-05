<?php

namespace Plivo\Util;

use Plivo\Authentication\BasicAuth;
use Plivo\Exceptions\PlivoValidationException;
use \Firebase\JWT\JWT;

/**
 * Class jwt
 * @package Plivo\Util
 */
class AccessToken
{
    protected $basicAuth;
    protected $username;
    protected $validFrom;
    protected $lifetime = 86400;
    protected $grants = [];
    protected $uid;

    /**
     * Instantiates a new AccessToken object.
     *
     * @param string|null $authId
     * @param string|null $authToken
     * @param string $username endpoint
     * @param integer|null $validFrom valid not before this epoch
     * @param integer|null $lifetime validity in seconds
     * @param integer|null $validTill validity expires at this epoch
     * @param null $uid
     */
    public function __construct(
        $authId = null,
        $authToken = null,
        $username = null,
        $validFrom = null,
        $lifetime = null,
        $validTill = null,
        $uid = null
    )
    {
        $this->basicAuth = new BasicAuth($authId, $authToken);
        if ($username == null) {
            throw new PlivoValidationException("null username not allowed");
        }
        $this->username = $username;
        $this->validFrom = intval($validFrom?:gmdate('U'));
        $this->lifetime = intval($lifetime?:86400);
        if ($lifetime != null) {
            if ($validTill != null) {
                throw new PlivoValidationException("use either lifetime or validTill");
            }
        } else if ($validTill != null) {
            $this->lifetime = intval($validTill)-$this->validFrom;
            if ($this->lifetime < 180 || $this->lifetime > 86400) {
                throw new PlivoValidationException("lifetime out of [180, 86400]");
            }
        }
        $this->uid = $uid?:$this->username."-".microtime(true);
    }
    /**
     * Adds voice calling permissions to the token
     *
     * @param bool $incoming
     * @param bool $outgoing
     */
    public function addVoiceGrants($incoming = false, $outgoing = false)
    {
        $this->grants = array(
            "voice" => array(
                "incoming_allow" => $incoming,
                "outgoing_allow" => $outgoing
            )
        );
    }

    /**
     * Returns JWT
     * @returns string $jwt
     */
    public function toJwt() {
        $key = $this->basicAuth->getAuthToken();
        $headers = array(
            "typ" => "JWT",
            "alg" => "HS256",
            "cty" => "plivo;v=1"
        );
        $payload = array(
            "jti" => $this->uid,
            "iss" => $this->basicAuth->getAuthId(),
            "sub" => $this->username,
            "nbf" => $this->validFrom,
            "exp" => $this->validFrom + $this->lifetime,
            "grants" => $this->grants
        );

        return JWT::encode($payload, $key, "HS256", null, $headers);
    }
}
