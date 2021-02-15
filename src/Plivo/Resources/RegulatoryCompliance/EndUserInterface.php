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
 * Class EndUserInterface
 * @package Plivo\Resources\RegulatoryCompliance
 * @property ResourceList $list
 * @method ResourceList list(array $optionalArgs)
 */
class EndUserInterface extends ResourceInterface
{
    /**
     * EndUserInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/EndUser/";
    }


    /**
     * This method lets you create a new endUser
     * @param string $name
     * @param string $lastName
     * @param string $endUserType
     * @param null|string $appID
     * @return JSON output
     * @throws PlivoValidationException
     */
    public function create($name, $endUserType, $lastName = null, $appID = null)
    {
        $mandatoryArgs = [
            'name' => $name,
            'end_user_type' => $endUserType
        ];

        if (ArrayOperations::checkNull($mandatoryArgs)) {
            throw new PlivoValidationException(
                "Mandatory parameters cannot be null");
        }

        $response = $this->client->update(
            $this->uri,
            array_merge($mandatoryArgs, ['app_id' => $appID, 'last_name' => $lastName])
        );
        $responseContents = $response->getContent();
        if(!array_key_exists("error", $responseContents)){

            return new EndUserCreateResponse(
                $responseContents['name'],
                $responseContents['last_name'],
                $responseContents['end_user_id'],
                $responseContents['end_user_type'],
                $responseContents['created_at'],
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
     * This method lets you get details of a single endUser on your account using the $endUserId.
     * @param $endUserId
     * @return EndUser
     * @throws PlivoValidationException
     */
    public function get($endUserId)
    {
        if (ArrayOperations::checkNull([$endUserId])) {
            throw
            new PlivoValidationException(
                'endUserId is mandatory');
        }
        $response = $this->client->fetch(
            $this->uri . $endUserId .'/',
            []
        );

        if(!array_key_exists("error", $response->getContent())){
            return new EndUser(
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
     * This method lets you get details of all endUsers.
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
            $endUsers = [];
            foreach ($response->getContent()['objects'] as $endUser) {
                $newEndUser = new EndUser($this->client, $endUser, $this->pathParams['authId']);
                array_push($endUsers, $newEndUser);
            }
            return new ResourceList($this->client, $response->getContent()['meta'], $endUsers);
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
     * Modify an endUser
     *
     * @param $endUserId
     * @param array $optionalArgs
     *   + Valid arguments
     *   + [string] name - The name of your endUser.
     *   + [string] last_name - The last name of your endUser.
     *   + [string] end_user_type - The type of the endUser.
     * @return ResponseUpdate
     */
    public function update($endUserId, array $optionalArgs = [])
    {
        $response = $this->client->update(
            $this->uri . $endUserId . '/',
            $optionalArgs
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
                "",
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * Delete an endUser
     *
     * @param $endUserId
     * @throws PlivoValidationException
     */
    public function delete($endUserId)
    {
        if (ArrayOperations::checkNull([$endUserId])) {
            throw
            new PlivoValidationException(
                'endUserId is mandatory');
        }
        $response = $this->client->delete(
            $this->uri . $endUserId . '/',
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
