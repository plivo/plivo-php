<?php

namespace Plivo\Resources\VerifyCallerId;

use Plivo\Resources\ResponseUpdate;

/**
 * Class Verify
 * @package Plivo\Resources\VerifyCallerId
 */

class Verify extends ResponseUpdate{

    protected $alias;
    protected $country;
    protected $createdAt;
    protected $modifiedAt;
    protected $phoneNumber;
    protected $subaccount;
    protected $verificationUuid;

    /**
     * Verify constructor.
     * @param string alias
     * @param string country
     * @param string createdAt
     * @param string modifiedAt
     * @param string phoneNumber
     * @param string subaccount
     * @param string verificationUuid
     */
    public function __construct($apiID, $alias, $country, $createdAt, $modifiedAt, $phoneNumber, $subaccount, $verificationUuid, $statusCode)
    {
        parent::__construct($apiID, '',$statusCode);

        $this->alias = $alias;
        $this->country = $country;
        $this->createdAt = $createdAt;
        $this->modifiedAt = $modifiedAt;
        $this->phoneNumber = $phoneNumber;
        $this->subaccount = $subaccount;
        $this->verificationUuid = $verificationUuid;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getModifiedAt(): string
    {
        return $this->modifiedAt;
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
