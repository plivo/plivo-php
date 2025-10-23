<?php

namespace Plivo\Resources\RegulatoryCompliance;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class ComplianceDocument
 * @package Plivo\Resources\RegulatoryCompliance
 * @property string $complianceDocumentId A unique ID for your ComplianceDocument. All API operations will be performed with this ID.
 * @property string $endUserId
 * @property string $documentTypeId
 * @property string $createdAt
 * @property string $alias
 * @property string $fileName
 * @property string $metaInformation
 */
class ComplianceDocument extends Resource
{
    function __construct(BaseClient $client, array $response, $authId)
    {
        parent::__construct($client);

        $complianceDocumentId = $fileName = "";
        if (array_key_exists('compliance_document_id', $response)) {
            $complianceDocumentId = $response['compliance_document_id'];
        }
        if (array_key_exists('document_id', $response)) {
            $complianceDocumentId = $response['document_id'];
        }

        if (array_key_exists('file', $response)) {
            $fileName = $response['file'];
        }
        if (array_key_exists('file_name', $response)) {
            $fileName = $response['file_name'];
        }

        $this->properties = [
            'complianceDocumentId' => $complianceDocumentId,
            'fileName' => $fileName,
            'documentTypeId' => $response['document_type_id'],
            'endUserId' => $response['end_user_id'],
            'createdAt' => $response['created_at'],
            'alias' => $response['alias'],
            'metaInformation' => $response['meta_information']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'complianceDocumentId' => $complianceDocumentId
        ];

        $this->id = $complianceDocumentId;
    }
}