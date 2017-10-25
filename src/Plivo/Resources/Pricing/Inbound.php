<?php

namespace Plivo\Resources\Pricing;


/**
 * Class Inbound
 * @package Plivo\Resources\Pricing
 */
class Inbound
{
    public $rate;

    /**
     * Inbound constructor.
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