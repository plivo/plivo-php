<?php

namespace Plivo\Resources\RegulatoryCompliance;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class ComplianceRequirement
 * @package Plivo\Resources\RegulatoryCompliance
 * @property string $complianceRequirementId
 * @property string $countryISO2
 * @property string $endUserType
 * @property string $numberType
 * @property array $acceptableDocumentTypes
 */
class ComplianceRequirement extends Resource
{
    function __construct(BaseClient $client, array $response, $authId)
    {
        parent::__construct($client);

        $this->properties = [
            'complianceRequirementId' => $response['compliance_requirement_id'],
            'countryISO2' => $response['country_iso2'],
            'endUserType' => $response['end_user_type'],
            'numberType' => $response['number_type'],
            'acceptableDocumentTypes' => $response['acceptable_document_types']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'complianceRequirementId' => $response['compliance_requirement_id'],
        ];

        $this->id = $response['compliance_requirement_id'];
    }
}