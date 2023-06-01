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
     * @param {string} brand_alias
     * @param {string} profile_uuid
     * @param {string} brand_type
     * @param {string} secondary_vetting
     * @param array optionalArgs contains callback, method
     * @return brandCreation response output
     */
    public function create($brand_alias,$profile_uuid,$brand_type,$secondary_vetting, array $optionalArgs = [])
    {
        $mandaoryArgs = [
            'brand_alias' => $brand_alias,
            'profile_uuid' => $profile_uuid,
            'brand_type' => $brand_type,
            'secondary_vetting' => $secondary_vetting
        ];
        $response = $this->client->update(
            $this->uri .'10dlc/Brand/',
            array_merge($mandaoryArgs, $optionalArgs)
        );

        return $response->getContent();   
    }


     /**
     * @param $brandId
     * @return BrandUsecases
     * @throws PlivoValidationException
     */
    public function get_brand_usecases($brandId)
    {
        if (ArrayOperations::checkNull([$brandId])) {
            throw
            new PlivoValidationException(
                'brand id is mandatory');
        }

        $response = $this->client->fetch(
            $this->uri . '10dlc/Brand/'. $brandId .'/usecases' . '/',
            []
        );
        $responseContents = $response->getContent();
        return new BrandUsecase(
            $this->client, $responseContents,
            $this->pathParams['authId'], $this->uri);
    }

    /**
     * @param $brand_id
     * @return Message
     * @throws PlivoValidationException
     */
    public function delete($brandId)
    {
        if (ArrayOperations::checkNull([$brandId])) {
            throw
            new PlivoValidationException(
                'brand id is mandatory');
        }

        $response = $this->client->delete(
            $this->uri . '10dlc/Brand/'. $brandId .'/',
            []
        );
        
        return $response->getContent();
    }

}