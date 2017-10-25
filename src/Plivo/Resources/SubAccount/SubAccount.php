<?php

namespace Plivo\Resources\SubAccount;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class SubAccount
 * @package Plivo\Resources\SubAccount
 * @property string $account The parent account of the subaccount.
 * @property string $authId The auth ID of the subaccount.
 * @property string $authToken The auth token of the subaccount.
 * @property string $created The date on which the subaccount was created.
 * @property boolean $enabled Status of the account if it is available.
 * @property string $name Name of the subaccount.
 * @property string|null $modified
 * @property string $resourceUri The resource URI of the subaccount.
 */
class SubAccount extends Resource
{
    /**
     * SubAccount constructor.
     * @param BaseClient $client
     * @param array $response
     * @param string $authId
     * @param string $subAuthId
     */
    public function __construct(
        BaseClient $client, $response, $authId, $subAuthId)
    {
        parent::__construct($client);

        $this->properties = [
            'account' => $response['account'],
            'authId' => $response['auth_id'],
            'authToken' => $response['auth_token'],
            'created' => $response['created'],
            'enabled' => $response['enabled'],
            'modified' => $response['modified'],
            'name' => $response['name'],
            'resourceUri' => $response['resource_uri']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'subAuthId' => $subAuthId
        ];

        $this->id = $subAuthId;
    }

    /**
     * Proxy the actions to the interface
     * @return SubAccountInterface
     */
    public function proxyToInterface()
    {
        if (!$this->interface) {
            $this->interface = new SubAccountInterface($this->client, $this->pathParams['authId']);
        }

        return $this->interface;
    }

    /**
     * Update the subaccount
     * @param string $name The name of the subaccount
     * @param boolean|null $enabled Specify if the subaccount should be enabled
     * or not. Takes a value of True or False.
     * @return \Plivo\Resources\ResponseUpdate
     */
    public function update($name, $enabled = null)
    {
        return $this->proxyToInterface()->update(
            $this->pathParams['subAuthId'], $name, $enabled);
    }

    /**
     * Delete the subaccount
     * @return \Plivo\Resources\ResponseDelete
     */
    public function delete()
    {
        return $this->proxyToInterface()->delete(
            $this->pathParams['subAuthId']);
    }
}