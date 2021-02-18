<?php

namespace Plivo\Resources\RegulatoryCompliance;


use Plivo\Resources\ResponseUpdate;

/**
 * Class ComplianceApplicationCreateResponse
 * @package Plivo\Resources\RegulatoryCompliance
 */
class ComplianceApplicationCreateResponse extends ResponseUpdate
{
    /**
     * @var string The complianceApplicationId of the ComplianceApplication
     */
    public $complianceApplicationId;
    /**
     * @var string The complianceRequirementId of the ComplianceApplication
     */
    public $complianceRequirementId;
    /**
     * @var string The countryISO2 of the ComplianceApplication
     */
    public $countryISO2;
    /**
     * @var string The ID of the ComplianceApplication
     */
    public $endUserId;
     /**
     * @var string The endUserType of the ComplianceApplication
     */
    public $endUserType;
     /**
     * @var string The numberType of the ComplianceApplication
     */
    public $numberType;
     /**
     * @var string The status of the ComplianceApplication
     */
    public $status;
    /**
     * @var string The creation time of the ComplianceApplication
     */
    public $createdAt;
    /**
     * @var string The alias of the ComplianceApplication
     */
    public $alias;
    /**
     * @var array The documents of the ComplianceApplication
     */
    public $documents;

    /**
     * ComplianceApplicationCreateResponse constructor.
     * @param string $complianceApplicationId
     * @param string $complianceRequirementId
     * @param string $countryISO2
     * @param string $endUserId
     * @param string $endUserType
     * @param string $numberType
     * @param string $status
     * @param string $alias
     * @param string $createdAt
     * @param array $documents
     * @param string $apiID
     * @param string $statusCode
     */
    public function __construct($complianceApplicationId, $complianceRequirementId, $countryISO2, $endUserId, $endUserType, $numberType, $status, $alias, $createdAt, $documents, $message, $apiID, $statusCode)
    {
        parent::__construct($apiID, $message, $statusCode);
        $this->complianceApplicationId = $complianceApplicationId;
        $this->complianceRequirementId = $complianceRequirementId;
        $this->countryISO2 = $countryISO2;
        $this->endUserId = $endUserId;
        $this->endUserType = $endUserType;
        $this->numberType = $numberType;
        $this->status = $status;
        $this->alias = $alias;
        $this->createdAt = $createdAt;
        $this->documents = $documents;
    }

    /**
     * Get the complianceApplicationId of the ComplianceApplication
     * @return string
     */
    public function getComplianceApplicationId()
    {
        return $this->complianceApplicationId;
    }

    /**
     * Get the complianceRequirementId of the ComplianceApplication
     * @return string
     */
    public function getComplianceRequirementId()
    {
        return $this->complianceRequirementId;
    }

    /**
     * Get the countryISO2 of the ComplianceApplication
     * @return string
     */
    public function getCountryISO2()
    {
        return $this->countryISO2;
    }

    /**
     * Get the endUserId of the ComplianceApplication
     * @return string
     */
    public function getEndUserId()
    {
        return $this->endUserId;
    }

    /**
     * Get the endUserType of the ComplianceApplication
     * @return string
     */
    public function getEndUserType()
    {
        return $this->endUserType;
    }

     /**
     * Get the alias of the ComplianceApplication
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Get the createdAt of the ComplianceApplication
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

     /**
     * Get the numberType of the ComplianceApplication
     * @return string
     */
    public function getNumberType()
    {
        return $this->numberType;
    }

    /**
     * Get the status of the ComplianceApplication
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

     /**
     * Get the documents of the ComplianceApplication
     * @return string
     */
    public function getDocuments()
    {
        return $this->documents;
    }
}