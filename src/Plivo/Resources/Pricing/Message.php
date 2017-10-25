<?php

namespace Plivo\Resources\Pricing;


/**
 * Class Message
 * @package Plivo\Resources\Pricing
 */
class Message
{
    /**
     * @var Inbound
     */
    public $inbound; //Inbound
    /**
     * @var Outbound
     */
    public $outbound; //Outbound
    /**
     * @var OutboundNetwork
     */
    public $outboundNetworksList; //array(OutboundNetwork)

    /**
     * Message constructor.
     * @param Inbound $inbound
     * @param Outbound $outbound
     * @param array $outboundNetworksList
     */
    function __construct(
        Inbound $inbound,
        Outbound $outbound,
        array $outboundNetworksList)
    {
        $this->inbound = $inbound;
        $this->outbound = $outbound;
        $this->outboundNetworksList = $outboundNetworksList;
    }
}