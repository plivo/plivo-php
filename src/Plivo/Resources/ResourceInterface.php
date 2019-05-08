<?php

namespace Plivo\Resources;


use Plivo\Exceptions\PlivoRestException;
use Plivo\BaseClient;

/**
 * Class ResourceInterface
 * @package Plivo\Resources
 */
class ResourceInterface
{
    /**
     * @var BaseClient
     */
    protected $client;

    /**
     * @var array
     */
    protected $pathParams = [];

    /**
     * @var
     */
    protected $uri;

    /**
     * ResourceInterface constructor.
     * @param BaseClient $plivoClient
     */
    function __construct(BaseClient $plivoClient)
    {
        $this->client = $plivoClient;
    }

    /**
     * Lazy getter to get methods
     * @param $name
     * @return mixed
     * @throws PlivoRestException
     */
    public function __get($name) {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        throw new PlivoRestException('Unknown resource property ' . $name);
    }

    /**
     * Lazy caller to call methods with arguments
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws PlivoRestException
     */
    public function __call($name, $arguments)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return call_user_func_array([$this, $method], $arguments);
        }

        throw new PlivoRestException('Unknown method ' . $name);
    }
}