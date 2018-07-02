<?php

namespace Plivo\Resources;


use Plivo\Exceptions\PlivoRestException;
use Plivo\BaseClient;

/**
 * Class Resource
 * @package Plivo\Resources
 */
class Resource
{
    /**
     * @var BaseClient
     */
    protected $client;

    /**
     * @var ResourceInterface
     */
    protected $interface = null;

    /**
     * @var null
     */
    protected $id = null;

    /**
     * @var array
     */
    protected $pathParams = [];

    /**
     * @var array
     */
    public $properties = [];

    /**
     * Resource constructor.
     * @param BaseClient $client
     */
    function __construct(BaseClient $client)
    {
        $this->client = $client;
    }

    /**
     * Lazy getter to get the properties by name
     * @param $name
     * @return mixed
     * @throws PlivoRestException
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        throw new PlivoRestException('Resource does not contain ' . $name);
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }



}