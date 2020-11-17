<?php

namespace Plivo\Resources\Powerpack;



use Plivo\Exceptions\PlivoValidationException;
use Plivo\Exceptions\PlivoRestException;
use Plivo\Exceptions\PlivoResponseException;
use Plivo\Util\ArrayOperations;
use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;
use Plivo\Exceptions\PlivoNotFoundException;
use Plivo\Resources\ResourceList;

/**
 * Class PowerpackInterface
 * @package Plivo\Resources\Powerpack
 */
class PowerpackInterface extends ResourceInterface
{
    /**
     * PowerpackInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    /**
     * @var null
     */
    public $number_pool;
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
     * @return Powerpack
     * @throws PlivoValidationException
     */
    public function get($uuid)
    {
        if (ArrayOperations::checkNull([$uuid])) {
            throw
            new PlivoValidationException(
                'powerpack uuid is mandatory');
        }

        $response = $this->client->fetch(
            $this->uri . 'Powerpack/'. $uuid .'/',
            []
        );
        $responseContents = $response->getContent();
        $numberpoolPath = $responseContents['number_pool'];
        $numberpool_arr = explode ("/", $numberpoolPath);
        $number_pool_uuid = $numberpool_arr[5];
        return new Powerpack(
            $this->client, $responseContents,
            $this->pathParams['authId'], $this->uri, $number_pool_uuid);
    }

  

     /**
     * Return a list of powerpack
     * @param array $optionalArgs
    *  + [int] limit - 
    *   + [int] offset - 
     * @return ResourceList output
     */
    public function list( $optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri . 'Powerpack/',
            $optionalArgs
        );

        return $response->getContent();
    }

    /**
     * Create a new powerpack
     *
     * @param string $name The name of your powerpack
     * @param array $optionalArgs
     *   + Valid arguments with their types
     *   + string sticky_sender - 
     *   + string local_connect - 
     *   + string application_type - 
     *   + string application_id - 
     *   + array number_priority -
     *
     * @return PowerpackCreateResponse output
     */
    public function create(
        $name, array $optionalArgs = [])
    {
        $mandaoryArgs = [
            'name' => $name
        ];

        $response = $this->client->update(
            $this->uri .'Powerpack/',
            array_merge($mandaoryArgs, $optionalArgs)
        );

        return $response->getContent();   
    }
    
}