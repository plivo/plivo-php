<?php

namespace Plivo\Resources\HostedMessaging;

use Plivo\BaseClient;
use Plivo\Exceptions\PlivoResponseException;
use Plivo\Exceptions\PlivoValidationException;
use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResourceList;
use Plivo\Util\ArrayOperations;

/**
 * Class HostedMessageLOAInterface
 * @package Plivo\Resources\HostedMessaging
 * @property ResourceList $list
 * @method ResourceList list(array $optionalArgs)
 */
class HostedMessageLOAInterface extends ResourceInterface {

    public function __construct(BaseClient $plivoClient, $authId) {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/HostedMessagingNumber/LOA/";
    }

    /**
     *
     * @param $alias
     * @param $file
     * @return HostedMessageLOACreateResponse
     * @throws PlivoResponseException
     * @throws PlivoValidationException
     */
    public function create($alias, $file): HostedMessageLOACreateResponse
    {
        $mandatoryArgs = [
            'alias' => $alias,
            'file' => $file
        ];

        if (ArrayOperations::checkNull($mandatoryArgs)) {
            throw new PlivoValidationException(
                "Mandatory parameters cannot be null");
        }

        $multipart = $this->constructLOAFilePayload($file);
        foreach ($mandatoryArgs as $key => $value) {
            $multipart[] = [
                'name' => $key,
                'contents' => $value
            ];
        }
        $response = $this->client->update(
            $this->uri,
            ['multipart' => $multipart]
        );
        $responseContents = $response->getContent();
        if(!array_key_exists("error", $responseContents)){
            return new HostedMessageLOACreateResponse(
                $responseContents['loa_id'],
                $responseContents['alias'],
                $responseContents['linked_numbers'],
                $responseContents['api_id'],
                $responseContents['file'],
                $responseContents['created_at'],
                $responseContents['message'],
                $responseContents['resource_uri'],
                $response->getStatusCode()
            );
        }
        throw new PlivoResponseException(
            "",
            0,
            null,
            $response->getContent(),
            $response->getStatusCode()
        );
    }

    /**
     * @param $hostedMessageLOAId
     * @return HostedMessageLOA
     * @throws PlivoResponseException
     * @throws PlivoValidationException
     */
    public function get($hostedMessageLOAId): HostedMessageLOA
    {
        if (ArrayOperations::checkNull([$hostedMessageLOAId])) {
            throw
            new PlivoValidationException(
                '$hostedMessageLOAId is mandatory');
        }
        $response = $this->client->fetch(
            $this->uri . $hostedMessageLOAId .'/',
            []
        );

        if(!array_key_exists("error", $response->getContent())) {
            return new HostedMessageLOA(
                $this->client, $response->getContent(),
                $this->pathParams['authId']
            );
        }
        throw new PlivoResponseException(
            $response->getContent()['error'],
            0,
            null,
            $response->getContent(),
            $response->getStatusCode()
        );
    }

    /**
     * @param array $optionalArgs
     * @return ResourceList
     * @throws PlivoResponseException
     */
    public function getList(array $optionalArgs = []): ResourceList
    {
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );

        if(!array_key_exists("error", $response->getContent())){
            $hostedMessageLOAs = [];
            foreach ($response->getContent()['objects'] as $hmLOA) {
                $newHmLOA = new HostedMessageLOA($this->client, $hmLOA, $this->pathParams['authId']);
                $hostedMessageLOAs[] = $newHmLOA;
            }
            return new ResourceList($this->client, $response->getContent()['meta_response'], $hostedMessageLOAs);
        } else {
            throw new PlivoResponseException(
                is_array($response->getContent()['error']) ? $response->getContent()['error']['message'] : $response->getContent()['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * @param $hostedMessageLOAId
     * @return void
     * @throws PlivoResponseException
     * @throws PlivoValidationException
     */
    public function delete($hostedMessageLOAId) {
        if (ArrayOperations::checkNull([$hostedMessageLOAId])) {
            throw
            new PlivoValidationException(
                '$hostedMessageLOAId is mandatory');
        }
        $response = $this->client->delete(
            $this->uri . $hostedMessageLOAId .'/',
            []
        );
        if (array_key_exists("error", $response->getContent()) &&
        is_array($response->getContent()["error"]) ? count($response->getContent()["error"]) : strlen($response->getContent()["error"])) {
            throw new PlivoResponseException(
                is_array($response->getContent()['error']) ? $response->getContent()['error']['message'] : $response->getContent()['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * Helper method
     * This method lets you construct payload
     * @param null|string $file
     * @param null|string $appID
     * @return array output
     * @throws PlivoValidationException
     */
    private function constructLOAFilePayload($path): array
    {
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
}