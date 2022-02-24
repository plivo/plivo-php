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
class HostedMessagingNumberInterface extends ResourceInterface {
    public function __construct(BaseClient $plivoClient, $authId) {
        parent::__construct($plivoClient);
        $this->uri = "Account/".$authId."/HostedMessagingNumber/";
    }

    /**
     * @param $alias
     * @param $loaId
     * @param $appId
     * @param $number
     * @return HostedMessageCreateResponse
     * @throws PlivoValidationException
     * @throws PlivoResponseException
     */
    public function create($alias, $loaId, $appId, $number) {
        $mandatoryArgs = [
            'loa_id' => $loaId,
            'application_id' => $appId,
            'alias' => $alias,
            'number' => $number
        ];

        if (ArrayOperations::checkNull($mandatoryArgs)) {
            throw new PlivoValidationException(
                "Mandatory parameters cannot be null");
        }

        $response = $this->client->update(
            $this->uri,
            $mandatoryArgs
        );

        $responseContents = $response->getContent();

        if(!array_key_exists("error", $responseContents)) {
            return new HostedMessageCreateResponse(
                $responseContents['hosted_messaging_number_id'],
                $responseContents['application'],
                $responseContents['loa_id'],
                $responseContents['number'],
                $responseContents['alias'],
                $responseContents['created_at'],
                $responseContents['failure_reason'],
                $responseContents['hosted_status'],
                $responseContents['resource_uri'],
                $responseContents['api_id'],
                $responseContents['message'],
                $response->getStatusCode()
            );
        }
        throw new PlivoResponseException(
            is_array($response->getContent()['error']) ? $response->getContent()['error']['message'] : $response->getContent()['error'],
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
            $hostedMessageNumbers = [];
            foreach ($response->getContent()['objects'] as $hmNumber) {
                $newHmNumber = new HostedMessageNumber($this->client, $hmNumber, $this->pathParams['authId']);
                $hostedMessageNumbers[] = $newHmNumber;
            }
            return new ResourceList($this->client, $response->getContent()['meta_response'], $hostedMessageNumbers);
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
     * @param $hostedMessagingNumberId
     * @return HostedMessageNumber
     * @throws PlivoValidationException
     * @throws PlivoResponseException
     */
    public function get($hostedMessagingNumberId) {
        if (ArrayOperations::checkNull([$hostedMessagingNumberId])) {
            throw
            new PlivoValidationException(
                '$hostedMessagingNumberId is mandatory');
        }
        $response = $this->client->fetch(
            $this->uri . $hostedMessagingNumberId .'/',
            []
        );

        if(!array_key_exists("error", $response->getContent())) {
            return new HostedMessageNumber(
                $this->client, $response->getContent(),
                $this->pathParams['authId']
            );
        }
        throw new PlivoResponseException(
            is_array($response->getContent()['error']) ? $response->getContent()['error']['message'] : $response->getContent()['error'],
            0,
            null,
            $response->getContent(),
            $response->getStatusCode()
        );
    }
}