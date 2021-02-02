<?php

namespace Plivo\Resources\RegulatoryCompliance;


use Plivo\Resources\ResponseUpdate;

/**
 * Class EndUserCreateResponse
 * @package Plivo\Resources\RegulatoryCompliance
 */
class EndUserCreateResponse extends ResponseUpdate
{
    /**
     * @var string The name of the endUser
     */
    public $name;
    /**
     * @var string The last name of the endUser
     */
    public $lastName;
    /**
     * @var string The ID of the endUser
     */
    public $endUserId;
    /**
     * @var string The Type of the endUser
     */
    public $endUserType;
    /**
     * @var string The creation time of the endUser
     */
    public $createdAt;

    /**
     * EndUserCreateResponse constructor.
     * @param string $message
     * @param string $name
     * @param string $lastName
     * @param string $endUserId
     * @param string $endUserType
     * @param string $createdAt
     * @param string $apiID
     * @param string $statusCode
     */
    public function __construct($name, $lastName, $endUserId, $endUserType, $createdAt, $message, $apiID, $statusCode)
    {
        parent::__construct($apiID, $message, $statusCode);
        $this->name = $name;
        $this->lastName = $lastName;
        $this->endUserId = $endUserId;
        $this->endUserType = $endUserType;
        $this->createdAt = $createdAt;
    }

    /**
     * Get the name of the endUser
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the last name of the endUser
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Get the ID of the endUser
     * @return string
     */
    public function getEndUserId()
    {
        return $this->endUserId;
    }

    /**
     * Get the endUserType of the endUser
     * @return string
     */
    public function getEndUserType()
    {
        return $this->endUserType;
    }

    /**
     * Get the createdAt of the endUser
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}