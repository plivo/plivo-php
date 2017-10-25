<?php

namespace Plivo\Resources\Account;

use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResponseUpdate;


/**
 * Class AccountInterface
 * @package Plivo\Resources
 */
class AccountInterface extends ResourceInterface
{
    /**
     * AccountInterface constructor.
     * @param BaseClient $plivoClient The Plivo api REST client
     * @param string $authId The authentication token
     */
    public function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);

        $this->pathParams = [
            'authId' => $authId
        ];

        $this->uri = "Account/".$authId."/";
    }

    /**
     * You can call this method to retrieve details like email address, cash credits,
     * postal address, auto recharge settings, etc which is associated with your
     * Plivo account. Returns an object representing your Plivo account.
     * @return Account
     */
    public function get()
    {
        $params = [];

        $response = $this->client->fetch(
            $this->uri,
            $params
        );

        return new Account(
            $this->client,
            $response->getContent(),
            $this->pathParams['authId']
        );
    }

    /**
     * If you would like to modify your account details, you could do so with
     * this method. You can make changes to the name, city and the address fields.
     * @param string $name Name of the account holder or business.
     * @param string $city City of the account holder.
     * @param string $address Address of the account holder.
     * @return ResponseUpdate
     */
    public function update($name, $city, $address) {

        $data = [
            'name' => $name,
            'city' => $city,
            'address' => $address
        ];

        $response = $this->client->update(
            $this->uri,
            $data
        );

        $responseContents = $response->getContent();

        return new ResponseUpdate($responseContents['message']);
    }
}