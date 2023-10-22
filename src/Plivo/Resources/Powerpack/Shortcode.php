<?php

namespace Plivo\Resources\Powerpack;


use Plivo\BaseClient;
use Plivo\Resources\Resource;
use Plivo\Util\ArrayOperations;
use Plivo\Exceptions\PlivoNotFoundException;
use Plivo\Exceptions\PlivoValidationException;



/**
 * Class Shortcode
 * @package Plivo\Resources\Powerpack
 * @property bool $added_on
 * @property bool $country_iso2
 * @property string $shortcode
 * @property string $number_pool_uuid
 */
class Shortcode
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
     * @return Shortcode
     */
    public function get()
    {
        return new Shortcode($this->client, $this->$uri);
    }

    public function list($optionalArgs = []){
        $response = $this->client->fetch(
        $this->uri . '/Shortcode/' ,
        $optionalArgs
        );
        return $response->getContent();
    }
    
    public function find($shortcode){
        if (ArrayOperations::checkNull([$shortcode])) {
            throw
            new PlivoValidationException(
                'shortcode is mandatory');
        }
        $response = $this->client->fetch(
            $this->uri . '/Shortcode/' . $shortcode . '/', []
        );
        return $response->getContent();
    }

    public function remove( $shortcode, $optionalArgs = [])
    {
        if (ArrayOperations::checkNull([$shortcode])) {
            throw
            new PlivoValidationException(
                'shortcode is mandatory');
        }
        $response = $this->client->delete(
            $this->uri . '/Shortcode/' . $shortcode . '/',
            $optionalArgs  
        );
        return $response->getContent();

    }

}