<?php

namespace Plivo\Resources\Powerpack;


use Plivo\BaseClient;
use Plivo\Resources\Resource;
use Plivo\Util\ArrayOperations;
use Plivo\Exceptions\PlivoNotFoundException;
use Plivo\Exceptions\PlivoValidationException;


/**
 * Class Numbers
 * @property string $account_phone_number_resource
 * @property bool $added_on
 * @property bool $country_iso2
 * @property string $number
 * @property string $number_pool_uuid
 * @property string $type
 */
class Numbers
{
    /**
     * @var null
     */
    private $client;

    /**
     * @var string
     */
    private $url;

     /**
     * @var string
     */
    private $powerpack_url;

    public function __construct($client = null, $url = null, $powerpack_url= null)
    {
        $this->client = $client;
        $this->url = $url;
        $this->powerpack_url = $powerpack_url;
    }

     /**
     * 
     * @return Numbers
     */
    public function get()
    {
        return new Numbers($this->client, $this->$url);
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

    public function count( $optionalArgs = [])
    {      
        $response = $this->client->fetch(
            $this->url . '/Number/' ,
             $optionalArgs
        );
        $res  = $response->getContent()['meta']['total_count'];
        if (empty($res)) {
            return "0";
        }
        return strval($res);
    }

    /**
     * Add an number
     * @param string number
     * @param array $optionalArgs
     * Valid arguments
     *  + [string] service  (Supported services are 'sms' and 'mms'. Defaults to 'sms' if   not set)
     * @return Response
     */
    public function add( $number, $optionalArgs = [])
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
     * Remove an powerpack
     * @param bool unrent
     * @return ResponseDelete
     */
    public function remove( $number, $optionalArgs = [])
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
     * @param $number
     * * @param array $optionalArgs
     * Valid arguments
     *  + [string] service  (Supported services are 'sms' and 'mms'. Defaults to 'sms' if   not set)
     * @return Powerpack
     * 
     * @throws PlivoValidationException
     */
    public function find( $number, $optionalArgs = [])
    {
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
     * @param array $optionalArgs
     * Valid arguments
     *  + [string] service  (Supported services are 'sms' and 'mms'. Defaults to 'sms' if   not set)
     * @return Response
     * 
     */
    public function list( $optionalArgs = [])
    {   
        $response = $this->client->fetch(
            $this->url . '/Number/' ,
             $optionalArgs
        );
        return $response->getContent();
    }
    
}