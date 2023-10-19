<?php

namespace Plivo\Resources\VerifyCallerId;

use Plivo\Resources\ResponseUpdate;

/**
 * Class VerifyCallerIdResponse
 * @package Plivo\Resources\VerifyCallerId
 */

class VerifyCallerIdResponse extends ResponseUpdate{

    protected $alias;
    protected $channel;
    protected $country;
    protected $createdAt;
    protected $phoneNumber;
    protected $subaccount;
    protected $verificationUuid;

    /**
     * Verify constructor.
     * @param string alias
     * @param string channel
     * @param string country
     * @param string createdAt
     * @param string phoneNumber
     * @param string subaccount
     * @param string verificationUuid
     */
    public function __construct($apiID, $alias, $channel, $country, $createdAt, $phoneNumber, $subaccount, $verificationUuid, $statusCode)
    {
        parent::__construct($apiID, '',$statusCode);

        $this->alias = $alias;
        $this->channel = $channel;
        $this->country = $country;
        $this->createdAt = $createdAt;
        $this->phoneNumber = $phoneNumber;
        $this->subaccount = $subaccount;
        $this->verificationUuid = $verificationUuid;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getSubaccount(): string
    {
        return $this->subaccount;
    }

    public function getVerificationUuid(): string
    {
        return $this->verificationUuid;
    }
    
}
