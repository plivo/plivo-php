<?php

namespace Plivo\Resources\Powerpack;


use Plivo\BaseClient;
use Plivo\Resources\Resource;
use Plivo\Util\ArrayOperations;
use Plivo\Exceptions\PlivoNotFoundException;
use Plivo\Exceptions\PlivoValidationException;

/**
 * Class Tollfree
 * @package Plivo\Resources\Powerpack
 * @property bool $added_on
 * @property bool $country_iso2
 * @property string $tollfree
 * @property string $number_pool_uuid
 */
class Tollfree
{
    /**
     * Message constructor.
     * @param BaseClient $client The Plivo API REST client
     * @param array $response
     * @param string $authId
     */
    /**
     * @var null
     */
    protected $client;

    /**
     * @var string
     */
    private $uri;

    public function __construct($client = null, $url = null)
    {
        $this->client = $client;
        $this->uri = $url;
    }

     /**
     * 
     * @return Tollfree
     */
    public function get()
    {
        return new Tollfree($this->client, $this->$uri);
    }

    public function list($optionalArgs = []){
        $response = $this->client->fetch(
        $this->uri . '/Tollfree/' ,
        $optionalArgs
        );
        return $response->getContent();
    }
    
    public function find($tollfree){
        if (ArrayOperations::checkNull([$tollfree])) {
            throw
            new PlivoValidationException(
                'tollfree is mandatory');
        }
        $response = $this->client->fetch(
            $this->uri . '/Tollfree/' . $tollfree . '/', []
        );
        return $response->getContent();
    }

    /**
     * Add tollfree
     * @param string tollfree
     * @return Response
     */
    public function add( $tollfree)
    {
       if (ArrayOperations::checkNull([$tollfree])) {
            throw
            new PlivoValidationException(
                'tollfree is mandatory');
        } 
       $response = $this->client->update(
            $this->uri . '/Tollfree/' . $tollfree . '/',
            [] 
        );
        return $response->getContent();
    
    }

    public function remove( $tollfree, $optionalArgs = [])
    {
        if (ArrayOperations::checkNull([$tollfree])) {
            throw
            new PlivoValidationException(
                'tollfree is mandatory');
        }
        $response = $this->client->delete(
            $this->uri . '/Tollfree/' . $tollfree . '/',
            $optionalArgs  
        );
        return $response->getContent();

    }

}