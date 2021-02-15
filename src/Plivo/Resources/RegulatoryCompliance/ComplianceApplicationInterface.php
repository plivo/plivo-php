<?php

namespace Plivo\Resources\RegulatoryCompliance;


use Plivo\Exceptions\PlivoValidationException;
use Plivo\Exceptions\PlivoResponseException;
use Plivo\BaseClient;

use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResourceList;

use Plivo\Resources\ResponseUpdate;
use Plivo\Util\ArrayOperations;

/**
 * Class ComplianceApplicationInterface
 * @package Plivo\Resources\RegulatoryCompliance
 * @property ResourceList $list
 * @method ResourceList list(array $optionalArgs)
 */
class ComplianceApplicationInterface extends ResourceInterface
{
    /**
     * ComplianceApplicationInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/ComplianceApplication/";
    }

    /**
     * This method lets you create a new complianceApplication
     * @param string $alias
     * @param string $endUserId
     * @param string $documentIds
     * @param null|string $complianceRequirementId
     * @param null|array $optionalArgs
     * @param null|string $appID
     * @return JSON output
     * @throws PlivoValidationException
     */
    public function create($alias, $endUserId, $documentIds, $complianceRequirementId = null, $optionalArgs = [], $appID = null)
    {
        $mandatoryArgs = [
            'end_user_id' => $endUserId,
            'document_ids' => $documentIds,
            'alias' => $alias
        ];

        if (ArrayOperations::checkNull($mandatoryArgs)) {
            throw new PlivoValidationException(
                "Mandatory parameters cannot be null");
        }

        $response = $this->client->update(
            $this->uri,
            array_merge($mandatoryArgs, $optionalArgs, ['app_id' => $appID, 'compliance_requirement_id' => $complianceRequirementId])
        );
        $responseContents = $response->getContent();

        if(!array_key_exists("error", $responseContents)){
            return new ComplianceApplicationCreateResponse(
                $responseContents['compliance_application_id'],
                $responseContents['compliance_requirement_id'],
                $responseContents['country_iso2'],
                $responseContents['end_user_id'],
                $responseContents['end_user_type'],
                $responseContents['number_type'],
                $responseContents['status'],
                $responseContents['alias'],
                $responseContents['created_at'],
                $responseContents['documents'],
                $responseContents['message'],
                $responseContents['api_id'],
                $response->getStatusCode()
            );
        } else {
            throw new PlivoResponseException(
                "",
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * This method lets you get details of a single complianceApplication on your account using the $complianceApplicationId.
     * @param $complianceApplicationId
     * @return ComplianceApplication
     * @throws PlivoValidationException
     */
    public function get($complianceApplicationId)
    {
        if (ArrayOperations::checkNull([$complianceApplicationId])) {
            throw
            new PlivoValidationException(
                'complianceApplicationId is mandatory');
        }
        $response = $this->client->fetch(
            $this->uri . $complianceApplicationId .'/',
            []
        );

        if(!array_key_exists("error", $response->getContent())){
            return new ComplianceApplication(
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
     * This method lets you get details of all complianceApplications.
     * @param array $optionalArgs
     * @return ResourceList
     */
    public function getList($optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );

        if(!array_key_exists("error", $response->getContent())){
            $complianceApplications = [];
            foreach ($response->getContent()['objects'] as $complianceApplication) {
                $newComplianceApplication = new ComplianceApplication($this->client, $complianceApplication, $this->pathParams['authId']);
                array_push($complianceApplications, $newComplianceApplication);
            }
            return new ResourceList($this->client, $response->getContent()['meta'], $complianceApplications);
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
     * Modify a complianceApplication
     *
     * @param $complianceApplicationId
     * @param array $documentIds
     * @param null|string $appID
     * @return ResponseUpdate
     */
    public function update($complianceApplicationId, array $documentIds = [], $appID = null)
    {
        $response = $this->client->update(
            $this->uri . $complianceApplicationId . '/',
            ['document_ids' => $documentIds]
        );

        $responseContents = $response->getContent();

        if(!array_key_exists("error", $responseContents)){
            return new ResponseUpdate(
                $responseContents['api_id'],
                $responseContents['message'],
                $response->getStatusCode()
            );
        } else {
            throw new PlivoResponseException(
                "",
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * Delete a complianceApplication
     *
     * @param $complianceApplicationId
     * @throws PlivoValidationException
     */
    public function delete($complianceApplicationId)
    {
        if (ArrayOperations::checkNull([$complianceApplicationId])) {
            throw
            new PlivoValidationException(
                'complianceApplicationId is mandatory');
        }
        $response = $this->client->delete(
            $this->uri . $complianceApplicationId . '/',
            []
        );
        if(array_key_exists("error", $response->getContent()) && strlen($response->getContent()['error']) > 0) {
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
     * Submit a complianceApplication
     *
     * @param $complianceApplicationId
     * @param null|string $appID
     * @return ResponseUpdate
     */
    public function submit($complianceApplicationId, $appID = null)
    {
        $response = $this->client->update(
            $this->uri . $complianceApplicationId . '/Submit/',
            []
        );

        $responseContents = $response->getContent();

        if(!array_key_exists("error", $responseContents)){
            return new ComplianceApplicationCreateResponse(
                $responseContents['compliance_application_id'],
                $responseContents['compliance_requirement_id'],
                $responseContents['country_iso2'],
                $responseContents['end_user_id'],
                $responseContents['end_user_type'],
                $responseContents['number_type'],
                $responseContents['status'],
                $responseContents['alias'],
                $responseContents['created_at'],
                $responseContents['documents'],
                'submitted',
                $responseContents['api_id'],
                $response->getStatusCode()
            );
        } else {
            throw new PlivoResponseException(
                "",
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }
}
