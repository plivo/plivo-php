<?php

namespace Plivo\Resources\RegulatoryCompliance;


use Plivo\Exceptions\PlivoValidationException;
use Plivo\BaseClient;
use Plivo\Exceptions\PlivoResponseException;

use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResourceList;

use Plivo\Util\ArrayOperations;

/**
 * Class ComplianceDocumentTypeInterface
 * @package Plivo\Resources\RegulatoryCompliance
 * @property ResourceList $list
 * @method ResourceList list(array $optionalArgs)
 */
class ComplianceDocumentTypeInterface extends ResourceInterface
{
    /**
     * ComplianceDocumentTypeInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/ComplianceDocumentType/";
    }

    /**
     * This method lets you get details of a single complianceDocumentType on your account using the $complianceDocumentTypeId.
     * @param $complianceDocumentTypeId
     * @return ComplianceDocumentType
     * @throws PlivoValidationException
     */
    public function get($complianceDocumentTypeId)
    {
        if (ArrayOperations::checkNull([$complianceDocumentTypeId])) {
            throw
            new PlivoValidationException(
                'complianceDocumentTypeId is mandatory');
        }
        $response = $this->client->fetch(
            $this->uri . $complianceDocumentTypeId .'/',
            []
        );

        if(!array_key_exists("error", $response->getContent())){
            return new ComplianceDocumentType(
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
     * This method lets you get details of all complianceDocumentTypes.
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
            $complianceDocumentTypes = [];
            foreach ($response->getContent()['objects'] as $complianceDocumentType) {
                $newComplianceDocumentType = new ComplianceDocumentType($this->client, $complianceDocumentType, $this->pathParams['authId']);
                array_push($complianceDocumentTypes, $newComplianceDocumentType);
            }
            return new ResourceList($this->client, $response->getContent()['meta'], $complianceDocumentTypes);
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
