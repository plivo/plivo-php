<?php
namespace Plivo\Resources\Powerpack;
use Plivo\BaseClient;
use Plivo\Resources\Resource;
/**
 * Class NumberPool
 * @package Plivo\Resources\Powerpack
 */
class NumberPool 
{
    /**
     * @var null
     */
    private $client;

    /**
     * @var string
     */
    public $number_pool_uuid;

    /**
     * @var number object
     */
    public $numbers;

    /**
     * @var shortcode object
     */
    public $shortcodes;

    public function __construct($client = null, $url)
    {
        $this->client = $client;
        $this->shortcodes = new Shortcode($this->client, $url);
        $this->numbers = new Numbers($this->client, $url);
    }
}