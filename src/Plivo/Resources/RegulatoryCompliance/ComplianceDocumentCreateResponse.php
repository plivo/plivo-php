<?php

namespace Plivo\Resources\RegulatoryCompliance;


use Plivo\Resources\ResponseUpdate;

/**
 * Class ComplianceDocumentCreateResponse
 * @package Plivo\Resources\RegulatoryCompliance
 */
class ComplianceDocumentCreateResponse extends ResponseUpdate
{
    /**
     * @var string The documentId of the ComplianceDocument
     */
    public $documentId;
    /**
     * @var string The documentTypeId of the ComplianceDocument
     */
    public $documentTypeId;
    /**
     * @var string The ID of the ComplianceDocument
     */
    public $endUserId;
    /**
     * @var string The creation time of the ComplianceDocument
     */
    public $createdAt;
    /**
     * @var string The alias of the ComplianceDocument
     */
    public $alias;
    /**
     * @var string The fileName of the ComplianceDocument
     */
    public $fileName;
    /**
     * @var string The metaInformation of the ComplianceDocument
     */
    public $metaInformation;

    /**
     * ComplianceDocumentCreateResponse constructor.
     * @param string $message
     * @param string $documentId
     * @param string $documentTypeId
     * @param string $fileName
     * @param string $endUserId
     * @param string $alias
     * @param string $createdAt
     * @param string $metaInformation
     * @param string $statusCode
     */
    public function __construct($documentId, $documentTypeId, $fileName, $endUserId, $alias, $createdAt, $metaInformation, $message, $apiID, $statusCode)
    {
        parent::__construct($apiID, $message, $statusCode);
        $this->documentId = $documentId;
        $this->documentTypeId = $documentTypeId;
        $this->fileName = $fileName;
        $this->endUserId = $endUserId;
        $this->alias = $alias;
        $this->metaInformation = $metaInformation;
        $this->createdAt = $createdAt;
    }

    /**
     * Get the documentId of the complianceDocument
     * @return string
     */
    public function getDocumentId()
    {
        return $this->documentId;
    }

    /**
     * Get the documentTypeId of the ComplianceDocument
     * @return string
     */
    public function getDocumentTypeId()
    {
        return $this->documentTypeId;
    }

    /**
     * Get the fileName of the ComplianceDocument
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Get the endUserId of the ComplianceDocument
     * @return string
     */
    public function getEndUserId()
    {
        return $this->endUserId;
    }

     /**
     * Get the alias of the ComplianceDocument
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Get the createdAt of the ComplianceDocument
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

     /**
     * Get the metaInformation of the ComplianceDocument
     * @return string
     */
    public function getMetaInformation()
    {
        return $this->metaInformation;
    }
}