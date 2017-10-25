<?php

namespace Plivo\Resources\Pricing;


/**
 * Class Local
 * @package Plivo\Resources\Pricing
 */
class Local
{
    public $rate; //String

    /**
     * Local constructor.
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