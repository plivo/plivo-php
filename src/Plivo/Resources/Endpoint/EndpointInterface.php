<?php

namespace Plivo\Resources\Endpoint;


use Plivo\Exceptions\PlivoValidationException;
use Plivo\BaseClient;

use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResourceList;

use Plivo\Resources\ResponseUpdate;
use Plivo\Util\ArrayOperations;

/**
 * Class EndpointInterface
 * @package Plivo\Resources\Endpoint
 * @property ResourceList $list
 * @method ResourceList list(array $optionalArgs)
 */
class EndpointInterface extends ResourceInterface
{
    /**
     * EndpointInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/Endpoint/";
    }


    /**
     * This method lets you create a new endpoint on Plivo
     * @param string $username
     * @param string $password
     * @param string $alias
     * @param null|string $appId
     * @return EndpointCreateReponse
     * @throws PlivoValidationException
     */
    public function create($username, $password, $alias, $appId = null)
    {
        $mandatoryArgs = [
            'username' => $username,
            'password' => $password,
            'alias' => $alias
        ];

        if (ArrayOperations::checkNull($mandatoryArgs)) {
            throw new PlivoValidationException(
                "Mandatory parameters cannot be null");
        }

        $response = $this->client->update(
            $this->uri,
            array_merge($mandatoryArgs, ['app_id' => $appId])
        );

        $responseContents = $response->getContent();

        return new EndpointCreateReponse(
            $responseContents['message'],
            $responseContents['username'],
            $responseContents['alias'],
            $responseContents['endpoint_id']);
    }

    /**
     * This method lets you get details of a single endpoint on your account using the $endpointId.
     * @param $endpointId
     * @return Endpoint
     * @throws PlivoValidationException
     */
    public function get($endpointId)
    {
        if (ArrayOperations::checkNull([$endpointId])) {
            throw
            new PlivoValidationException(
                'endpoint id is mandatory');
        }

        $response = $this->client->fetch(
            $this->uri . $endpointId .'/',
            []
        );

        return new Endpoint(
            $this->client, $response->getContent(),
            $this->pathParams['authId']);
    }

    /**
     * This method lets you get details of all endpoints. This is pretty useful
     * in use-cases where you want statuses of your endpoints and whether they
     * have been registered using a SIP client.
     * @param array $optionalArgs
     * @return ResourceList
     */
    public function getList($optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );

        $endpoints = [];

        foreach ($response->getContent()['objects'] as $endpoint) {
            $newEndpoint = new Endpoint($this->client, $endpoint, $this->pathParams['authId']);

            array_push($endpoints, $newEndpoint);
        }

        return new ResourceList($this->client, $response->getContent()['meta'], $endpoints);
    }

    /**
     * Modify an endpoint
     *
     * @param $endpointId
     * @param array $optionalArgs
     *   + Valid arguments
     *   + [string] password - The password for your endpoint username.
     *   + [string] alias - Alias for this endpoint
     *   + [string] app_id - The app_id of the application that is to be attached to this endpoint. If app_id is not specified, then the endpoint does not point to any application.
     * @return ResponseUpdate
     */
    public function update($endpointId, array $optionalArgs = [])
    {
        $response = $this->client->update(
            $this->uri . $endpointId . '/',
            $optionalArgs
        );

        $responseContents = $response->getContent();

        return new ResponseUpdate($responseContents['message']);
    }
    
    /**
     * Delete an endpoint
     *
     * @param $endpointId
     * @throws PlivoValidationException
     */
    public function delete($endpointId)
    {
        if (ArrayOperations::checkNull([$endpointId])) {
            throw
            new PlivoValidationException(
                'endpoint id is mandatory');
        }
        
        $this->client->delete(
            $this->uri . $endpointId . '/',
            []
        );
    }
}