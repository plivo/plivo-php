<?php

namespace Plivo\Resources\RegulatoryCompliance;


use Plivo\Exceptions\PlivoValidationException;
use Plivo\Exceptions\PlivoResponseException;
use Plivo\BaseClient;

use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResourceList;

use Plivo\Util\ArrayOperations;

/**
 * Class ComplianceRequirementInterface
 * @package Plivo\Resources\RegulatoryCompliance
 * @property ResourceList $list
 * @method ResourceList list(array $optionalArgs)
 */
class ComplianceRequirementInterface extends ResourceInterface
{
    /**
     * ComplianceRequirementInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/ComplianceRequirement/";
    }

    /**
     * This method lets you get details of a single complianceRequirement on your account using the $complianceRequirementId.
     * @param $complianceRequirementId
     * @return ComplianceRequirement
     * @throws PlivoValidationException
     */
    public function get($complianceRequirementId)
    {
        if (ArrayOperations::checkNull([$complianceRequirementId])) {
            throw
            new PlivoValidationException(
                'complianceRequirementId is mandatory');
        }
        $response = $this->client->fetch(
            $this->uri . $complianceRequirementId .'/',
            []
        );

        if(!array_key_exists("error", $response->getContent())){
            return new ComplianceRequirement(
                $this->client, $response->getContent(),
                $this->pathParams['authId']
            );
        } else {
            throw new PlivoResponseException(
                $response->getContent()['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * This method lets you fetch a complianceRequirement via params
     * @param array $optionalArgs
     * @return ComplianceRequirement
     * @throws PlivoValidationException
     */
    public function getList($optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );

        if(!array_key_exists("error", $response->getContent())){
            return new ComplianceRequirement(
                $this->client, $response->getContent(),
                $this->pathParams['authId']
            );
        } else {
            throw new PlivoResponseException(
                $response->getContent()['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }

}
