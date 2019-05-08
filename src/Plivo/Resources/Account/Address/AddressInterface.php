<?php

namespace Plivo\Resources\Account\Address;

use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResponseUpdate;
use Plivo\Util\ArrayOperations;
use Plivo\Exceptions\PlivoValidationException;

/**
 * Class AccountInterface
 * @package Plivo\Resources
 */
class AddressInterface extends ResourceInterface
{
    /**
     * AccountInterface constructor.
     * @param BaseClient $plivoClient The Plivo api REST client
     * @param string $authId The authentication token
     */
    public function __construct(BaseClient $plivoClient, $accountUri)
    {
        parent::__construct($plivoClient);

        $this->pathParams = [
            'authId' => $authId
        ];

        $this->uri = $accountUri . "Verification/Address/";
    }

    /**
     * You can call this method to retrieve all your addresses
     * @return Array
     */
    public function list()
    {
        $response = $this->client->fetch(
            $this->uri,
            []
        );

        return json_encode($response->getContent(), JSON_FORCE_OBJECT);
    }

    /**
     * You can call this method to fetch a particular address
     * @return Array
     */
    public function get($addressId)
    {
        $uri = $this->uri . $addressId . '/';
        $response = $this->client->fetch(
            $uri,
            []
        );

        return json_encode($response->getContent(), JSON_FORCE_OBJECT);
    }

    /**
     * You can call this method to add an address
     * @return Array
     */
    public function add($params) 
    {
        $response = $this->client->update(
            $this->uri,
            $params
        );

        return json_encode($response->getContent(), JSON_FORCE_OBJECT);
    }

    /**
     * You can call this method to update an address
     * @return Array
     */
    public function update($addressId, $params) 
    {
        $uri = $this->uri . $addressId . '/';
        $response = $this->client->update(
            $uri,
            $params
        );

        return json_encode($response->getContent(), JSON_FORCE_OBJECT);
    }

    /**
     * Delete an address
     *
     * @param $addressId
     * @throws PlivoValidationException
     */
    public function delete($addressId)
    {
        if (ArrayOperations::checkNull([$addressId])) {
            throw
            new PlivoValidationException(
                'address id is mandatory');
        }

        $uri = $this->uri . $addressId . '/';
        
        $response = $this->client->delete(
            $uri,
            []
        );

        return json_encode($response->getContent(), JSON_FORCE_OBJECT);
    }
}