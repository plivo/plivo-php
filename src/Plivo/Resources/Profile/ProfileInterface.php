<?php

namespace Plivo\Resources\Profile;



use Plivo\Exceptions\PlivoValidationException;
use Plivo\Exceptions\PlivoRestException;
use Plivo\Exceptions\PlivoResponseException;
use Plivo\Util\ArrayOperations;
use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;
use Plivo\Exceptions\PlivoNotFoundException;
use Plivo\Resources\ResourceList;

/**
 * Class ProfileInterface
 * @package Plivo\Resources\Profile
 */
class ProfileInterface extends ResourceInterface
{
    /**
     * CampaignInterface constructor.
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
     * @param $profile
     * @return Profile
     * @throws PlivoValidationException
     */
    public function get($profileUUID)
    {
        if (ArrayOperations::checkNull([$profileUUID])) {
            throw
            new PlivoValidationException(
                'profile uuid is mandatory');
        }

        $response = $this->client->fetch(
            $this->uri . 'Profile/'. $profileUUID .'/',
            []
        );
        return $response->getContent();
    }

  

     /**
     * Return a list of profiles
     * @param array $optionalArgs
     * [int] :limit Used to display the number of results per page. The maximum number of results that can be fetched is 20.
     * [int] :offset Denotes the number of value items by which the results should be offset. Eg:- If the result contains a 1000 values and limit is set to 10 and offset is set to 705, then values 706 through 715 are displayed in the results. This parameter is also used for pagination of the results.
     * @return ResourceList output
     */
    public function list( $optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri . 'Profile/',
            $optionalArgs
        );

        return $response->getContent();
    }

    /**
     * Create a new Profile
     *
     * @param {string} profile_alias 
     * @param {string} profile_type 
     * @param {string} customer_type 
     * @param {string} entity_type 
     * @param {list} company_name 
     * @param {string} ein  
     * @param {boolean} vertical 
     * @param {boolean} ein_issuing_country 
     * @param {boolean} stock_symbol 
     * @param {boolean} stock_exchange 
     * @param {boolean} website 
     * @param {boolean} first_name 
     * @param {boolean} last_name 
     * @param {string} email 
     * @param {string} title 
     * @param {string} seniority 
     * @param {string} street 
     * @param {string} city 
     * @param {string} state 
     * @param {string} postalcode
     * @param {string} country
     * @return profileResponse response output
     */
    public function create($profile_alias,$plivo_subaccount,$customer_type,$entity_type, $company_name,$ein,$vertical,$ein_issuing_country,$stock_symbol,$stock_exchange, $alt_business_id_type, $website, $address, $authorized_contact, $optionalArgs = [])
    {
        $mandaoryArgs = [
            'profile_alias' => $profile_alias,
            'plivo_subaccount' => $plivo_subaccount,
            'customer_type' => $customer_type,
            'entity_type' => $entity_type,
            'company_name' => $company_name,
            'ein' => $ein,
            'vertical' => $vertical,
            'ein_issuing_country' => $ein_issuing_country,
            'stock_symbol' => $stock_symbol,
            'stock_exchange' => $stock_exchange,
            'website' => $website,
            'alt_business_id_type' => $alt_business_id_type,
        ];
        $optionalArgs['address'] = $address;
        $optionalArgs['authorized_contact'] = $authorized_contact;
        $response = $this->client->update(
            $this->uri .'Profile/',
            array_merge($mandaoryArgs, $optionalArgs)
        );
        return $response->getContent();   
    }


   /**
     * update a new Profile
     *
     * @param {string} profile_uuid 
     * @param {object } address
     * @param {object } authorized_contact
     * @param {string} entity_type
     * @param{string} vertical
     * @param{string} company_name
     * @param{string} website
     * @return profileResponse response output
     */
    public function update($profile_uuid, array $optionalArgs = [])
    {
        $response = $this->client->update(
            $this->uri .'Profile/'.$profile_uuid . '/',
            $optionalArgs
        );
        return $response->getContent();   
    }

    /**
     * delete a new Profile
     *
     * @param {string} profile_uuid 
     */
    public function delete($profile_uuid)
    {
        $response = $this->client->delete(
            $this->uri . 'Profile/' . $profile_uuid .'/', []
        );

        return $response->getContent();
    }
}