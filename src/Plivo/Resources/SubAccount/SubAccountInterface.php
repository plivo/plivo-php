<?php

namespace Plivo\Resources\SubAccount;


use Plivo\Exceptions\PlivoValidationException;
use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResponseDelete;
use Plivo\Resources\ResponseUpdate;
use Plivo\Util\ArrayOperations;

/**
 * Class SubAccountInterface
 * @package Plivo\Resources\SubAccount
 */
class SubAccountInterface extends ResourceInterface
{

    /**
     * SubAccountInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/Subaccount/";
    }

    /**
     * Create a new subaccount
     * @param string $name Name of the subaccount
     * @param boolean|null $enabled Specify if the subaccount should be enabled or
     * not. Takes a value of True or False. Defaults to False
     * @return SubAccountCreateResponse
     */
    public function create($name, $enabled = null)
    {
        if (is_null($name)) {
            throw new PlivoValidationException(
                "Mandatory parameters cannot be null");
        }

        $data = [
            'name' => $name,
            'enabled' => $enabled
        ];

        $response = $this->client->update(
            $this->uri,
            $data
        );

        $responseContents = $response->getContent();
        return new SubAccountCreateResponse($responseContents['message'], $responseContents['auth_id'], $responseContents['auth_token'], $responseContents['api_id']);
    }

    /**
     * Modify a subaccount
     *
     * @param string $subAuthId The auth ID of the subaccount to modify
     * @param string $name Name of the subaccount
     * @param bool|null $enabled Specify if the subaccount should be enabled or
     * not. Takes a value of True or False.
     * @return ResponseUpdate
     */
    public function update($subAuthId, $name = null, $enabled = null)
    {
        $data = [
            'name' => $name,
            'enabled' => $enabled
        ];

        $response = $this->client->update(
            $this->uri . $subAuthId . '/',
            $data
        );

        $responseContents = $response->getContent();

        return new ResponseUpdate(
            $responseContents['api_id'],
            $responseContents['message']
        );
    }

    /**
     * Delete a subaccount
     *
     * @param string $subAuthId The auth ID of the subaccount to delete
     * @return ResponseDelete
     */
    public function delete($subAuthId)
    {
        $response = $this->client->delete(
            $this->uri . $subAuthId . '/',
            []
        );

        return new ResponseDelete($response->getStatusCode());
    }

    /**
     * You can call this method to retrieve details of a subaccount like auth_id,
     * auth_token, etc. Returns an object representing your Plivo subaccount.
     *
     * @param string $subAuthId The auth ID of the subaccount to retrieve.
     * @return SubAccount
     * @throws PlivoValidationException
     */
    public function get($subAuthId)
    {
        if (ArrayOperations::checkNull([$subAuthId])) {
            throw
            new PlivoValidationException(
                'subauth id is mandatory');
        }

        $response = $this->client->fetch(
            $this->uri . $subAuthId . '/',
            []
        );

        return new SubAccount(
            $this->client,
            $response->getContent(),
            $this->pathParams['authId'],
            $subAuthId);
    }

    /**
     * You can get details of all subaccounts associated with your main
     * Plivo account. We return a list of all subaccounts.
     *
     * @param integer|null $limit Used to display the number of results per
     * page. The maximum number of results that can be fetched is 20.
     * @param integer|null $offset Denotes the number of value items by which
     * the results should be offset. Eg:- If the result contains a 1000 values
     * and limit is set to 10 and offset is set to 705, then values 706 through
     * 715 are displayed in the results. This parameter is also used for
     * pagination of the results.
     * @return SubAccountList
     */
    protected function getList($limit = null, $offset = null)
    {
        $params = [
            'limit' => $limit,
            'offset' => $offset
        ];

        $response = $this->client->fetch(
            $this->uri,
            $params
        );

        $subAccounts = [];

        foreach ($response->getContent()['objects'] as $subAccount) {
            $newSubAccount = new SubAccount(
                $this->client,
                $subAccount,
                $this->pathParams['authId'],
                $subAccount['auth_id']);

            array_push($subAccounts, $newSubAccount);
        }

        return new SubAccountList(
            $this->client,
            $response->getContent()['meta'],
            $subAccounts);
    }
}