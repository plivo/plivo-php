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
 * Class ComplianceDocumentInterface
 * @package Plivo\Resources\RegulatoryCompliance
 * @property ResourceList $list
 * @method ResourceList list(array $optionalArgs)
 */
class ComplianceDocumentInterface extends ResourceInterface
{
    /**
     * ComplianceDocumentInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/ComplianceDocument/";
    }

    /**
     * Helper method
     * This method lets you construct payload
     * @param null|string $file
     * @param null|string $appID
     * @return JSON output
     * @throws PlivoValidationException
     */
    private function constructComplianceDocumentFilePayload($path) {
        $files = array();
        if (!is_null($path)) {
            $files[] = [
                'name' => 'file',
                'contents' => file_get_contents($path),
                'filename' => basename($path)
            ];
        };
        return $files;
    }

    /**
     * This method lets you create a new complianceDocument
     * @param string $alias
     * @param string $endUserId
     * @param string $documentTypeId
     * @param null|string $path
     * @param null|string $dataFields
     * @param null|string $appID
     * @return JSON output
     * @throws PlivoValidationException
     */
    public function create($alias, $endUserId, $documentTypeId, $path = null, $dataFields = null, $appID = null)
    {
        $mandatoryArgs = [
            'end_user_id' => $endUserId,
            'document_type_id' => $documentTypeId,
            'alias' => $alias
        ];

        if (ArrayOperations::checkNull($mandatoryArgs)) {
            throw new PlivoValidationException(
                "Mandatory parameters cannot be null");
        }

        $multipart = $this->constructComplianceDocumentFilePayload($path);
        foreach ($mandatoryArgs as $key => $value) {
            $multipart[] = [
                'name' => $key,
                'contents' => $value
            ];
        }
        foreach ($dataFields as $key => $value) {
            $multipart[] = [
                'name' => $key,
                'contents' => $value
            ];
        }
        $multipart[] = [
            'name' => 'api_id',
            'contents' => $appID
        ];

        $response = $this->client->update(
            $this->uri,
            ['multipart' => $multipart]
        );
        $responseContents = $response->getContent();
        if(!array_key_exists("error", $responseContents)){
            return new ComplianceDocumentCreateResponse(
                $responseContents['document_id'],
                $responseContents['document_type_id'],
                $responseContents['file_name'],
                $responseContents['end_user_id'],
                $responseContents['alias'],
                $responseContents['created_at'],
                $responseContents['meta_information'],
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
     * This method lets you get details of a single complianceDocument on your account using the $complianceDocumentId.
     * @param $complianceDocumentId
     * @return ComplianceDocument
     * @throws PlivoValidationException
     */
    public function get($complianceDocumentId)
    {
        if (ArrayOperations::checkNull([$complianceDocumentId])) {
            throw
            new PlivoValidationException(
                'complianceDocumentId is mandatory');
        }
        $response = $this->client->fetch(
            $this->uri . $complianceDocumentId .'/',
            []
        );

        return new ComplianceDocument(
            $this->client, $response->getContent(),
            $this->pathParams['authId']);
    }

    /**
     * This method lets you get details of all complianceDocuments.
     * @param array $optionalArgs
     * @return ResourceList
     */
    public function getList($optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );

        $complianceDocuments = [];

        foreach ($response->getContent()['objects'] as $complianceDocument) {
            $newComplianceDocument = new ComplianceDocument($this->client, $complianceDocument, $this->pathParams['authId']);
            array_push($complianceDocuments, $newComplianceDocument);
        }
        return new ResourceList($this->client, $response->getContent()['meta'], $complianceDocuments);
    }

    /**
     * Modify an complianceDocument
     *
     * @param $complianceDocumentId
     * @param array $optionalArgs
     * @return JSON output
     *   + Valid arguments
     *   + [string] alias - The name of your complianceDocument.
     *   + [string] end_user_id - The last name of your complianceDocument.
     *   + [string] document_type_id - The type of the complianceDocument.
     * @param null|string $path
     * @param null|string $appID
     * @return ResponseUpdate
     */
    public function update($complianceDocumentId, array $optionalArgs = [], $path=null, $appID=null)
    {
        $multipart = $this->constructComplianceDocumentFilePayload($path);
        foreach ($optionalArgs as $key => $value) {
            $multipart[] = [
                'name' => $key,
                'contents' => $value
            ];
        }
        $multipart[] = [
            'name' => 'api_id',
            'contents' => $appID
        ];

        $response = $this->client->update(
            $this->uri . $complianceDocumentId . '/',
            ['multipart' => $multipart]
        );

        $responseContents = $response->getContent();

        if(!array_key_exists("error",$responseContents)){
            return new ResponseUpdate(
                $responseContents['api_id'],
                $responseContents['message'],
                $response->getStatusCode()
            );
        } else {
            throw new PlivoResponseException(
                $responseContents['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * Delete an complianceDocument
     *
     * @param $complianceDocumentId
     * @throws PlivoValidationException
     */
    public function delete($complianceDocumentId)
    {
        if (ArrayOperations::checkNull([$complianceDocumentId])) {
            throw
            new PlivoValidationException(
                'complianceDocumentId is mandatory');
        }
        $this->client->delete(
            $this->uri . $complianceDocumentId . '/',
            []
        );
    }
}
