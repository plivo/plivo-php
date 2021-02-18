<?php

namespace Plivo\Resources\RegulatoryCompliance;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class ComplianceApplication
 * @package Plivo\Resources\RegulatoryCompliance
 * @property string $complianceApplicationId A unique ID for your ComplianceApplication. All API operations will be performed with this ID.
 * @property string $alias
 * @property string $complianceRequirementId
 * @property string $countryISO2
 * @property string $endUserId
 * @property string $createdAt
 * @property string $endUserType
 * @property array $documents
 * @property string $numberType
 * @property string $status
 */
class ComplianceApplication extends Resource
{
    function __construct(BaseClient $client, array $response, $authId)
    {
        parent::__construct($client);

        $this->properties = [
            'complianceApplicationId' => $response['compliance_application_id'],
            'alias' => $response['alias'],
            'complianceRequirementId' => $response['compliance_requirement_id'],
            'countryISO2' => $response['country_iso2'],
            'endUserId' => $response['end_user_id'],
            'createdAt' => $response['created_at'],
            'documents' => $response['documents'],
            'endUserType' => $response['end_user_type'],
            'numberType' => $response['number_type'],
            'status' => $response['status']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'complianceApplicationId' => $response['compliance_application_id']
        ];

        $this->id = $response['compliance_application_id'];
    }
}