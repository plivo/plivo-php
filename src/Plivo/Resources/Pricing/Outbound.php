<?php

namespace Plivo\Resources\Pricing;


/**
 * Class Outbound
 * @package Plivo\Resources\Pricing
 */
class Outbound
{
    public $rate; //String

    /**
     * Outbound constructor.
     * @param string $rate
     */
    function __construct($rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }
}