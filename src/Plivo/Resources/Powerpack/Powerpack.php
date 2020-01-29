<?php

namespace Plivo\Resources\Powerpack;


use Plivo\BaseClient;
use Plivo\Resources\Resource;
use Plivo\Util\ArrayOperations;
use Plivo\Exceptions\PlivoNotFoundException;

/**
 * Class Powerpack
 * @package Plivo\Resources\Powerpack
 * @property string $name
 * @property bool $sticky_sender
 * @property bool $local_connect
 * @property string $application_type
 * @property string $application_type
 * @property string $created_on
 * @property string $number_pool
 */
class Powerpack extends Resource
{
    /**
     * Message constructor.
     * @param BaseClient $client The Plivo API REST client
     * @param array $response
     * @param string $authId
     */
    public $number_pool;

    private $number_pool_id;

    private $url;

    private $powerpack_url;

    public function __construct(
        BaseClient $client, $response, $authId, $url, $number_pool_uuid)
    {
        parent::__construct($client);

        $this->properties = [
            'name' => $response['name'],
            'sticky_sender' => $response['sticky_sender'],
            'application_id' => $response['application_id'],
            'application_type' => $response['application_type'],
            'created_on' => $response['created_on'],
            'local_connect' => $response['local_connect'],
            'number_pool' => $response['number_pool'],
        ];

        $this->pathParams = [
            'authId' => $authId,
            'uuid' => $response['uuid']
        ];
        $this->powerpack_url = $url;
        $this->url = $url . 'NumberPool/' . $number_pool_uuid ;
        $this->id = $response['uuid'];
        $numberpool_arr = explode ("/", $response['number_pool']);
        $this->number_pool_id = $numberpool_arr[5];
        $this->number_pool = new NumberPool($this->client, $this->url);
    }

    /**
     * Return a list of powerpack
     * @param array $optionalArgs
     * Valid arguments
     *   + [string] pattern 
     *   + [string] country_iso 
     *   + [string] type
    *  + [int] limit - 
    *   + [int] offset - 
     * @return ResourceList output
     */
    public function list_numbers( $optionalArgs = [])
    {
        if (ArrayOperations::checkNull([$this->id])) {
            throw
            new PlivoValidationException(
                'powerpack uuid is mandatory');
        }
        
        $response = $this->client->fetch(
            $this->url . '/Number/' ,
             $optionalArgs
        );
        return $response->getContent();
    }

    /**
     * @param $number
     * @return Powerpack
     * 
     * @throws PlivoValidationException
     */
    public function find_shortcode($shortcode)
    {
        if (ArrayOperations::checkNull([$this->id])) {
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
            $this->url . '/Shortcode/' . $shortcode . '/', []
        );
        return $response->getContent();   
        
    }

    /**
     * @param $number
     * @return Powerpack
     * 
     * @throws PlivoValidationException
     */
    public function find_number( $number)
    {
        if (ArrayOperations::checkNull([$this->id])) {
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
            $this->url . '/Number/' . $number . '/', []
        );
        return $response->getContent();
        
    }

     /**
     * Delete an powerpack
     * @param bool unrent_numbers
     * @return ResponseDelete
     */
    public function delete($optionalArgs = [])
    {
        if (ArrayOperations::checkNull([$this->id])) {
            throw
            new PlivoValidationException(
                'powerpack uuid is mandatory');
        }
       return $response = $this->client->delete(
            $this->powerpack_url . 'Powerpack/' . $this->id . '/',
            $optionalArgs = [] 
        );

    }

    /**
     * Remove an powerpack
     * @param bool unrent
     * @return ResponseDelete
     */
    public function remove_number( $number, $optionalArgs = [])
    {
        if (ArrayOperations::checkNull([$number])) {
            throw
            new PlivoValidationException(
                'number is mandatory');
        }
        $response = $this->client->delete(
            $this->url . '/Number/' . $number . '/',
            $optionalArgs  
        );
        return $response->getContent();

    }


    /**
     * Add an number
     * @param string number
     * @return Response
     */
    public function add_number( $number)
    {
       if (ArrayOperations::checkNull([$number])) {
            throw
            new PlivoValidationException(
                'number is mandatory');
        } 
       $response = $this->client->update(
            $this->url . '/Number/' . $number . '/',
            [] 
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
    public function update( array $optionalArgs = [])
    {
        if (ArrayOperations::checkNull([$this->id])) {
            throw
            new PlivoValidationException(
                'powerpack uuid is mandatory');
        }

        $response = $this->client->update(
            $this->powerpack_url .'Powerpack/' . $uuid .'/' ,
            $optionalArgs
        );

        return $response->getContent();   
    }  
    
    /**
     * Return a list of powerpack
     * @param array $optionalArgs
    *  + [int] limit - 
    *   + [int] offset - 
     * @return ResourceList output
     */
    public function list_shortcodes( $optionalArgs = [])
    {
        if (ArrayOperations::checkNull([$this->id])) {
            throw
            new PlivoValidationException(
                'powerpack uuid is mandatory');
        }
        
        $response = $this->client->fetch(
            $this->url . '/Shortcode/' ,
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
    public function count_numbers( $optionalArgs = [])
    {
        if (ArrayOperations::checkNull([$this->id])) {
            throw
            new PlivoValidationException(
                'powerpack uuid is mandatory');
        }        
        $response = $this->client->fetch(
            $this->url . '/Number/' ,
             $optionalArgs
        );
    
        return $response->getContent()['meta']['total_count'];
    }

    /**
     * Add an number
     * @param string $uuid
     * @param array optionalArgs
     * @return Response
     */
    public function buy_add_number( $optionalArgs = [])
    {
        $data = [
            'rent' => 'true'
        ];
        $number = $optionalArgs['number'];
        if (ArrayOperations::checkNull([$number])){
        $country_iso = $optionalArgs['country_iso2'];
        if (ArrayOperations::checkNull([$country_iso])) {
            throw
            new PlivoValidationException(
                'country_iso  is mandatory');
        }
        $response = $this->client->fetch(
            $this->powerpack_url .'PhoneNumber/',
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
        $this->url . '/Number/' . $number . '/',
        $data
      );
      return $response->getContent();      
    }

}