<?php

namespace Plivo\Resources\RegulatoryCompliance;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class ComplianceDocumentType
 * @package Plivo\Resources\RegulatoryCompliance
 * @property string $documentTypeId
 * @property string $documentName
 * @property string $description
 * @property string $proofRequired
 * @property string $createdAt
 * @property array $information
 */
class ComplianceDocumentType extends Resource
{
    function __construct(BaseClient $client, array $response, $authId)
    {
        parent::__construct($client);

        $this->properties = [
            'documentTypeId' => $response['document_type_id'],
            'documentName' => $response['document_name'],
            'description' => $response['description'],
            'proofRequired' => $response['proof_required'],
            'createdAt' => $response['created_at'],
            'information' => $response['information']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'documentTypeId' => $response['document_type_id'],
        ];

        $this->id = $response['document_type_id'];
    }
}