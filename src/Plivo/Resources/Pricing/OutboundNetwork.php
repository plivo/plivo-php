<?php

namespace Plivo\Resources\Pricing;


/**
 * Class OutboundNetwork
 * @package Plivo\Resources\Pricing
 */
class OutboundNetwork
{
    /**
     * @var string
     */
    public $groupName;
    /**
     * @var string
     */
    public $rate;

    /**
     * OutboundNetwork constructor.
     * @param string $groupName
     * @param string $rate
     */
    function __construct($groupName, $rate)
    {
        $this->groupName = $groupName;
        $this->rate = $rate;
    }

    /**
     * @return string
     */
    public function getGroupName()
    {
        return $this->groupName;
    }


    /**
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }
}