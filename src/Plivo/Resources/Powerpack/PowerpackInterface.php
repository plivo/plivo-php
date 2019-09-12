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
       return $response->getContent();
        
    }

    /**
     * Return a list of powerpack
     * @param array $optionalArgs
     * $uuid -- powerpack uuid
    *  + [int] limit - 
    *   + [int] offset - 
     * @return ResourceList output
     */
    public function getShortCodeList($uuid, $optionalArgs = [])
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
        
        $response = $this->client->fetch(
            $this->uri . 'NumberPool/' . $number_pool_uuid . '/Shortcode/' ,
          $optionalArgs
        );
        return $response->getContent();
    }

    /**
     * Return a list of powerpack
     * @param array $optionalArgs
     * Valid arguments
     *   + [string] pattern 
     *   + [string] country_iso 
     *   + [string] type
     * $uuid -- powerpack uuid
    *  + [int] limit - 
    *   + [int] offset - 
     * @return ResourceList output
     */
    public function getNumberList($uuid, $optionalArgs = [])
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
        
        $response = $this->client->fetch(
            $this->uri . 'NumberPool/' . $number_pool_uuid . '/Number/' ,
             $optionalArgs
        );
        return $response->getContent();
    }


/**
     * Return a count of number
     * @param array $optionalArgs
     * Valid arguments
     *   + [string] pattern 
     *   + [string] country_iso 
     *   + [string] type
     * $uuid -- powerpack uuid
    *  + [int] limit - 
    *   + [int] offset - 
     * @return count output
     */
    public function getCountNumber($uuid, $optionalArgs = [])
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
        
        $response = $this->client->fetch(
            $this->uri . 'NumberPool/' . $number_pool_uuid . '/Number/' ,
             $optionalArgs
        );
    
        return $response->getContent()['meta']['total_count'];
    }

     /**
     * Return a list of powerpack
     * @param array $optionalArgs
    *  + [int] limit - 
    *   + [int] offset - 
     * @return ResourceList output
     */
    public function getList( $optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri . 'Powerpack/',
            $optionalArgs
        );

        return $response->getContent();
    }


    /**
     * @param $uuid
     * @param $number
     * @return Powerpack
     * 
     * @throws PlivoValidationException
     */
    public function findNumber($uuid, $number)
    {
        if (ArrayOperations::checkNull([$uuid])) {
            throw
            new PlivoValidationException(
                'powerpack uuid is mandatory');
        }
        if (ArrayOperations::checkNull([$number])) {
            throw
            new PlivoValidationException(
                'number is mandatory');
        }
        $response = $this->client->fetch(
            $this->uri . 'Powerpack/'. $uuid .'/',
            []
        );
        
        $responseContents = $response->getContent();
        $numberpoolPath = $responseContents['number_pool'];
        $numberpool_arr = explode ("/", $numberpoolPath);
        $number_pool_uuid = $numberpool_arr[5];

        $response = $this->client->fetch(
            $this->uri . 'NumberPool/' . $number_pool_uuid . '/Number/' . $number . '/', []
        );
        return $response->getContent();
       
        
    }

    /**
     * @param $uuid
     * @param $number
     * @return Powerpack
     * 
     * @throws PlivoValidationException
     */
    public function findShortcode($uuid, $shortcode)
    {
        if (ArrayOperations::checkNull([$uuid])) {
            throw
            new PlivoValidationException(
                'powerpack uuid is mandatory');
        }
        if (ArrayOperations::checkNull([$shortcode])) {
            throw
            new PlivoValidationException(
                'shortcode is mandatory');
        }
        $response = $this->client->fetch(
            $this->uri . 'Powerpack/'. $uuid .'/',
            []
        );
        
        $responseContents = $response->getContent();
        $numberpoolPath = $responseContents['number_pool'];
        $numberpool_arr = explode ("/", $numberpoolPath);
        $number_pool_uuid = $numberpool_arr[5];

        $response = $this->client->fetch(
            $this->uri . 'NumberPool/' . $number_pool_uuid . '/Shortcode/' . $shortcode . '/', []
        );
        return $response->getContent();   
        
    }

    /**
     * Delete an powerpacl
     * @param string $uuid
     * @param bool unrent_numbers
     * @return ResponseDelete
     */
    public function delete($uuid, $unrent_numbers = False)
    {
        $data = [
            'unrent_numbers' => $unrent_numbers
        ];
       return $response = $this->client->delete(
            $this->uri . 'Powerpack/' . $uuid . '/',
            $data 
        );

    }

    /**
     * Delete an powerpacl
     * @param string $uuid
     * @param bool unrent
     * @return ResponseDelete
     */
    public function removeNumber($uuid, $number, $unrent = False)
    {
        $response = $this->client->fetch(
            $this->uri . 'Powerpack/'. $uuid .'/',
            []
        );
        
        $responseContents = $response->getContent();
        $numberpoolPath = $responseContents['number_pool'];
        $numberpool_arr = explode ("/", $numberpoolPath);
        $number_pool_uuid = $numberpool_arr[5];
        $data = [
            'unrent' => $unrent_numbers
        ];

       return $response = $this->client->delete(
            $this->uri . 'NumberPool/' . $number_pool_uuid . '/Number/' . $number . '/',
            $data 
        );

    }

    /**
     * Add an number
     * @param string $uuid
     * @param string number
     * @return Response
     */
    public function addNumber($uuid, $number)
    {
        $response = $this->client->fetch(
            $this->uri . 'Powerpack/'. $uuid .'/',
            []
        );
        
        $responseContents = $response->getContent();
        $numberpoolPath = $responseContents['number_pool'];
        $numberpool_arr = explode ("/", $numberpoolPath);
        $number_pool_uuid = $numberpool_arr[5];
        
       $response = $this->client->update(
            $this->uri . 'NumberPool/' . $number_pool_uuid . '/Number/' . $number . '/',
            [] 
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
    /**
     * Update a new powerpack
     *@param string uuid
     * @param string $name The name of your powerpack
     * @param array $optionalArgs
     *   + Valid arguments with their types
     *   + string sticky_sender - 
     *   + string local_connect - 
     *   + string application_type - 
     *   + string application_id - 
     *
     * @return PowerpackUpdateResponse output
     */
    public function update(
        $uuid, array $optionalArgs = [])
    {
        if (ArrayOperations::checkNull([$uuid])) {
            throw
            new PlivoValidationException(
                'powerpack uuid is mandatory');
        }

        $response = $this->client->update(
            $this->uri .'Powerpack/' . $uuid .'/' ,
            $optionalArgs
        );

        return $response->getContent();   
    }  


    /**
     * Add an number
     * @param string $uuid
     * @param array optionalArgs
     * @return Response
     */
    public function buyAndAdd($uuid, $optionalArgs = [], $number="")
    {
        $response = $this->client->fetch(
            $this->uri . 'Powerpack/'. $uuid .'/',
            []
        );
        $data = [
            'rent' => 'true'
        ];
        
        $responseContents = $response->getContent();
        $numberpoolPath = $responseContents['number_pool'];
        $numberpool_arr = explode ("/", $numberpoolPath);
        $number_pool_uuid = $numberpool_arr[5];
        
       if ($number == ""){
        $country_iso = $optionalArgs['country_iso2'];
        if (ArrayOperations::checkNull([$country_iso])) {
            throw
            new PlivoValidationException(
                'country_iso  is mandatory');
        }
        $response = $this->client->fetch(
            $this->uri .'/PhoneNumber/',
         $optionalArgs
        );
        if (ArrayOperations::checkNull([$response->getContent()['objects']])) {
            throw
            new PlivoNotFoundException(
                'Resource not found');
          }
        $phoneNumber = $response->getContent()['objects'][0];
        $number = $phoneNumber['number'];
       }
       if (ArrayOperations::checkNull([$number])) {
        throw
        new PlivoNotFoundException(
            'Resource not found');
      }

       $response = $this->client->update(
        $this->uri . 'NumberPool/' . $number_pool_uuid . '/Number/' . $number . '/',
        $data
      );
      return $response->getContent();      
}
}