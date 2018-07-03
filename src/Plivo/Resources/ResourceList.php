<?php

namespace Plivo\Resources;


use Plivo\BaseClient;

/**
 * Class ResourceList
 * @package Plivo\Resources
 */
class ResourceList implements \IteratorAggregate
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
     * @var
     */
    protected $meta;

    /**
     * @var array
     */
    protected $resources;

    /**
     * ResourceList constructor.
     * @param BaseClient $plivoClient
     * @param $meta
     * @param array $resources
     */
    function __construct(BaseClient $plivoClient, array $meta, array $resources)
    {
        $this->client = $plivoClient;
        $this->meta = $meta;
        $this->resources = $resources;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->resources);
    }

    /**
     * @return array
     */
    public function get()
    {
        return $this->resources;
    }

    /**
     * @return array
     */
    public function meta()
    {
        return $this->meta;
    }
}
