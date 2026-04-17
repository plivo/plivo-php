<?php

namespace Plivo\Resources\PhoneNumberCompliance;


use Plivo\Exceptions\PlivoValidationException;
use Plivo\Exceptions\PlivoResponseException;
use Plivo\BaseClient;

use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResourceList;

use Plivo\Resources\ResponseUpdate;
use Plivo\Util\ArrayOperations;

/**
 * Class PhoneNumberComplianceInterface
 * @package Plivo\Resources\PhoneNumberCompliance
 * @property ResourceList $list
 * @method ResourceList list(array $optionalArgs)
 */
class PhoneNumberComplianceInterface extends ResourceInterface
{
    /**
     * PhoneNumberComplianceInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/PhoneNumber/Compliance/";
    }

    /**
     * Build multipart payload for compliance create/update
     * @param array $data The data fields to include as JSON
     * @param array $documentPaths Array of file paths to upload
     * @return array
     */
    private function buildComplianceMultipart($data, $documentPaths = [])
    {
        $multipart = [];

        $multipart[] = [
            'name' => 'data',
            'contents' => json_encode($data),
        ];

        foreach ($documentPaths as $index => $path) {
            $handle = fopen($path, 'r');
            if ($handle === false) {
                throw new PlivoValidationException("File not found: " . $path);
            }
            $multipart[] = [
                'name' => 'documents[' . $index . '].file',
                'contents' => $handle,
                'filename' => basename($path),
            ];
        }

        return $multipart;
    }

    /**
     * Create a new phone number compliance
     * @param array $data
     * @param array $documentPaths
     * @return PhoneNumberComplianceCreateResponse
     * @throws PlivoValidationException
     * @throws PlivoResponseException
     */
    public function create($data, $documentPaths = [])
    {
        $multipart = $this->buildComplianceMultipart($data, $documentPaths);

        $response = $this->client->update(
            $this->uri,
            ['multipart' => $multipart]
        );

        $responseContents = $response->getContent();

        if(!array_key_exists("error", $responseContents)){
            return new PhoneNumberComplianceCreateResponse(
                $responseContents['compliance_id'],
                $responseContents['message'],
                $responseContents['api_id'],
                $response->getStatusCode()
            );
        } else {
            throw new PlivoResponseException(
                $responseContents['error'] ?? "",
                0,
                null,
                $responseContents,
                $response->getStatusCode()
            );
        }
    }

    /**
     * Get details of a single phone number compliance
     * @param string $complianceId
     * @param array $optionalArgs
     * @return PhoneNumberCompliance
     * @throws PlivoValidationException
     * @throws PlivoResponseException
     */
    public function get($complianceId, $optionalArgs = [])
    {
        if (ArrayOperations::checkNull([$complianceId])) {
            throw
            new PlivoValidationException(
                'complianceId is mandatory');
        }

        $response = $this->client->fetch(
            $this->uri . $complianceId . '/',
            $optionalArgs
        );

        $responseContents = $response->getContent();

        if(!array_key_exists("error", $responseContents)){
            $complianceData = $responseContents;
            if (array_key_exists('compliance', $responseContents)) {
                $complianceData = $responseContents['compliance'];
            }
            return new PhoneNumberCompliance(
                $this->client, $complianceData,
                $this->pathParams['authId']
            );
        } else {
            throw new PlivoResponseException(
                $responseContents['error'],
                0,
                null,
                $responseContents,
                $response->getStatusCode()
            );
        }
    }

    /**
     * Get details of all phone number compliances
     * @param array $optionalArgs
     * @return ResourceList
     * @throws PlivoResponseException
     */
    public function getList($optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );

        $responseContents = $response->getContent();

        if(!array_key_exists("error", $responseContents)){
            $compliances = [];
            $complianceArray = [];
            if (array_key_exists('compliances', $responseContents)) {
                $complianceArray = $responseContents['compliances'];
            } elseif (array_key_exists('objects', $responseContents)) {
                $complianceArray = $responseContents['objects'];
            }
            foreach ($complianceArray as $compliance) {
                $newCompliance = new PhoneNumberCompliance(
                    $this->client, $compliance, $this->pathParams['authId']
                );
                array_push($compliances, $newCompliance);
            }
            $meta = array_key_exists('meta', $responseContents) ? $responseContents['meta'] : [];
            return new ResourceList($this->client, $meta, $compliances);
        } else {
            throw new PlivoResponseException(
                $responseContents['error'],
                0,
                null,
                $responseContents,
                $response->getStatusCode()
            );
        }
    }

    /**
     * Update a phone number compliance
     * @param string $complianceId
     * @param array|null $data
     * @param array $documentPaths
     * @return ResponseUpdate
     * @throws PlivoValidationException
     * @throws PlivoResponseException
     */
    public function update($complianceId, $data = null, $documentPaths = [])
    {
        if (ArrayOperations::checkNull([$complianceId])) {
            throw
            new PlivoValidationException(
                'complianceId is mandatory');
        }

        $multipart = $this->buildComplianceMultipart($data ?: [], $documentPaths);

        $response = $this->client->patch(
            $this->uri . $complianceId . '/',
            ['multipart' => $multipart]
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
                $responseContents['error'] ?? "",
                0,
                null,
                $responseContents,
                $response->getStatusCode()
            );
        }
    }

    /**
     * Delete a phone number compliance
     * @param string $complianceId
     * @throws PlivoValidationException
     * @throws PlivoResponseException
     */
    public function delete($complianceId)
    {
        if (ArrayOperations::checkNull([$complianceId])) {
            throw
            new PlivoValidationException(
                'complianceId is mandatory');
        }
        $response = $this->client->delete(
            $this->uri . $complianceId . '/',
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
}
