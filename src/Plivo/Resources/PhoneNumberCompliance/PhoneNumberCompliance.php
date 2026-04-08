<?php

namespace Plivo\Resources\PhoneNumberCompliance;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class PhoneNumberCompliance
 * @package Plivo\Resources\PhoneNumberCompliance
 * @property string $complianceId
 * @property string $status
 * @property string $alias
 * @property string $countryIso
 * @property string $numberType
 * @property string $userType
 * @property array $endUser
 * @property array $documents
 * @property array $linkedNumbers
 * @property string $createdAt
 * @property string $updatedAt
 */
class PhoneNumberCompliance extends Resource
{
    function __construct(BaseClient $client, array $response, $authId)
    {
        parent::__construct($client);

        $this->properties = [
            'complianceId' => $response['compliance_id'] ?? null,
            'status' => $response['status'] ?? null,
            'alias' => $response['alias'] ?? null,
            'countryIso' => $response['country_iso'] ?? null,
            'numberType' => $response['number_type'] ?? null,
            'userType' => $response['user_type'] ?? null,
            'endUser' => $response['end_user'] ?? null,
            'documents' => $response['documents'] ?? null,
            'linkedNumbers' => $response['linked_numbers'] ?? null,
            'createdAt' => $response['created_at'] ?? null,
            'updatedAt' => $response['updated_at'] ?? null,
        ];

        $this->pathParams = [
            'authId' => $authId,
            'complianceId' => $response['compliance_id'] ?? null,
        ];

        $this->id = $response['compliance_id'] ?? null;
    }
}
