<?php

namespace Plivo\Resources\Pricing;


/**
 * Class Voice
 * @package Plivo\Resources\Pricing
 */
/**
 * Class Voice
 * @package Plivo\Resources\Pricing
 */
class Voice
{
    /**
     * @var string
     */
    public $inbound;
    /**
     * @var string
     */
    public $outbound;

    /**
     * Voice constructor.
     * @param $inbound
     * @param $outbound
     */
    function __construct($inbound, $outbound)
    {
        $this->inbound = $inbound;
        $this->outbound = $outbound;
    }
}