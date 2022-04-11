<?php

namespace Plivo\Resources\Powerpack;


use Plivo\BaseClient;
use Plivo\Resources\Resource;
use Plivo\Util\ArrayOperations;
use Plivo\Exceptions\PlivoNotFoundException;
use Plivo\Exceptions\PlivoValidationException;
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
 * @property array $number_priority
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
            'number_priority' => $response['number_priority'],
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
     *   + [string] service  (Supported services are 'sms' and 'mms'. Would list all numbers belonging to the pool, if   not set)
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
    public function find_tollfree($tollfree)
    {
        if (ArrayOperations::checkNull([$this->id])) {
            throw
            new PlivoValidationException(
                'powerpack uuid is mandatory');
        }
        if (ArrayOperations::checkNull([$tollfree])) {
            throw
            new PlivoValidationException(
                'tollfree is mandatory');
        }
    
        $response = $this->client->fetch(
            $this->url . '/Tollfree/' . $tollfree . '/', []
        );
        return $response->getContent();   
        
    }

    /**
     * @param $number
     * @param array $optionalArgs
     * Valid arguments
     *   + [string] service  (Supported services are 'sms' and 'mms'. Would search for both the services if not set)

     * @return Powerpack
     * 
     * @throws PlivoValidationException
     */
    public function find_number( $number, $optionalArgs = [])
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
            $this->url . '/Number/' . $number . '/', $optionalArgs 
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
     * Remove an tollfree
     * @param bool unrent
     * @return ResponseDelete
     */
    public function remove_tollfree( $tollfree, $optionalArgs = [])
    {
        if (ArrayOperations::checkNull([$tollfree])) {
            throw
            new PlivoValidationException(
                'tollfree is mandatory');
        }
        $response = $this->client->delete(
            $this->url . '/Tollfree/' . $tollfree . '/',
            $optionalArgs  
        );
        return $response->getContent();

    }

    /**
     * Remove an shortcode
     * @param bool unrent
     * @return ResponseDelete
     */
    public function remove_shortcode( $shortcode, $optionalArgs = [])
    {
        if (ArrayOperations::checkNull([$shortcode])) {
            throw
            new PlivoValidationException(
                'shortcode is mandatory');
        }
        $response = $this->client->delete(
            $this->url . '/Shortcode/' . $shortcode . '/',
            $optionalArgs  
        );
        return $response->getContent();

    }


    /**
     * Add an number
     * @param string number
     * @param array $optionalArgs
     * Valid arguments
     *   + [string] service  (Supported services are 'sms' and 'mms'. Default to 'sms' if not set.)
     * @return Response
     */
    public function add_number( $number, $optionalArgs = [])
    {
       if (ArrayOperations::checkNull([$number])) {
            throw
            new PlivoValidationException(
                'number is mandatory');
        } 
       $response = $this->client->update(
            $this->url . '/Number/' . $number . '/',
            $optionalArgs
        );
        return $response->getContent();
    
    }

    /**
     * Add a tollfree
     * @param string number
     * @return Response
     */
    public function add_tollfree( $tollfree)
    {
       if (ArrayOperations::checkNull([$tollfree])) {
            throw
            new PlivoValidationException(
                'tollfree is mandatory');
        } 
       $response = $this->client->update(
            $this->url . '/Tollfree/' . $tollfree . '/',
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
     *   + array number_priority -
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
            $this->powerpack_url .'Powerpack/' . $this->id .'/' ,
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
     * Return a list of tollfree
     * @param array $optionalArgs
    *  + [int] limit - 
    *   + [int] offset - 
     * @return ResourceList output
     */
    public function list_tollfree( $optionalArgs = [])
    {
        if (ArrayOperations::checkNull([$this->id])) {
            throw
            new PlivoValidationException(
                'powerpack uuid is mandatory');
        }
        
        $response = $this->client->fetch(
            $this->url . '/Tollfree/' ,
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
     *   + [string] service  (Supported services are 'sms' and 'mms'. Would give count of all numbers belonging to the pool if not set.)
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
     * + [string] service (Supported services are 'sms' and 'mms'. Defaults to 'sms' when not set)
     * @return Response
     */
    public function buy_add_number( $optionalArgs = [])
    {
        $data = [
            'rent' => 'true'
        ];
        $service = $optionalArgs['service'];
        if (ArrayOperations::checkNull([$service])) {
            $service = 'sms';
        }
        $data['service'] = $service;
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