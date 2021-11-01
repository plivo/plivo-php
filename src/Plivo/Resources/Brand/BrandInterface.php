<?php

namespace Plivo\Resources\Brand;



use Plivo\Exceptions\PlivoValidationException;
use Plivo\Exceptions\PlivoRestException;
use Plivo\Exceptions\PlivoResponseException;
use Plivo\Util\ArrayOperations;
use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;
use Plivo\Exceptions\PlivoNotFoundException;
use Plivo\Resources\ResourceList;

/**
 * Class BrandInterface
 * @package Plivo\Resources\Brand
 */
class BrandInterface extends ResourceInterface
{
    /**
     * BrandInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    /**
     * @var null
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
     * @param $uuid
     * @return Brand
     * @throws PlivoValidationException
     */
    public function get($brandId)
    {
        if (ArrayOperations::checkNull([$brandId])) {
            throw
            new PlivoValidationException(
                'brand id is mandatory');
        }

        $response = $this->client->fetch(
            $this->uri . '10dlc/Brand/'. $brandId .'/',
            []
        );
        $responseContents = $response->getContent();
        return new Brand(
            $this->client, $responseContents,
            $this->pathParams['authId'], $this->uri);
    }

  

     /**
     * Return a list of brands
     * @param array $optionalArgs
     * @return ResourceList output
     */
    public function list( $optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri . '10dlc/Brand/',
            $optionalArgs
        );

        return $response->getContent();
    }

    /**
     * Create a new brand
     *
    *  @param {object} params 
     * @param {string} city
     * @param {string} company_name
     * @param {string} country
     * @param {string} ein
     * @param {string} ein_issuing_country
     * @param {string} email
     * @param {string} entity_type
     * @param {string} postal_code
     * @param {string} registration_status
     * @param {string} state
     * @param {string} stock_exchange
     * @param {string} stock_symbol
     * @param {string} street
     * @param {string} vertical
     * @param {string} [params.website] -
     * @param {string} [params.secondary_vetting]
     * @param {string} [params.first_name]
     * @param {string} [params.last_name]
     * @param {string} [params.alt_business_id_type]
     * @param {string} [params.alt_business_id]
     * @return brandCreation response output
     */
    public function create($city,$company_name,$country,$ein,$ein_issuing_country,$email,$entity_type,$phone,$postal_code,$registration_status,$state,$stock_exchange,$stock_symbol,$street,$vertical, array $optionalArgs = [])
    {
        $mandaoryArgs = [
            'city' => $city,
            'company_name' => $company_name,
            'country' => $country,
            'ein' => $ein,
            'ein_issuing_country' => $ein_issuing_country,
            'email' => $email,
            'entity_type' => $entity_type,
            'phone' => $phone,
            'postal_code' => $postal_code,
            'registration_status' => $registration_status,
            'state' => $state,
            'stock_exchange' => $stock_exchange,
            'stock_symbol' => $stock_symbol,
            'street' => $street,
            'vertical' => $vertical
        ];

        $response = $this->client->update(
            $this->uri .'10dlc/Brand/',
            array_merge($mandaoryArgs, $optionalArgs)
        );

        return $response->getContent();   
    }

}