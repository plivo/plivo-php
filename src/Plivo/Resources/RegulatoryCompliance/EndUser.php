<?php

namespace Plivo\Resources\RegulatoryCompliance;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class EndUser
 * @package Plivo\Resources\RegulatoryCompliance
 * @property string $endUserId A unique ID for your endUser. All API operations will be performed with this ID.
 * @property string $createdAt
 * @property string $name
 * @property string $lastName
 * @property string $endUserType
 */
class EndUser extends Resource
{
    function __construct(BaseClient $client, array $response, $authId)
    {
        parent::__construct($client);

        $this->properties = [
            'endUserId' => $response['end_user_id'],
            'createdAt' => $response['created_at'],
            'name' => $response['name'],
            'lastName' => $response['last_name'],
            'endUserType' => $response['end_user_type']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'endUserId' => $response['end_user_id']
        ];

        $this->id = $response['end_user_id'];
    }
}