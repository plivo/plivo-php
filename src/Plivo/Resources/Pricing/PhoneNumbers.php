<?php

namespace Plivo\Resources\Pricing;


/**
 * Class PhoneNumbers
 * @package Plivo\Resources\Pricing
 */
/**
 * Class PhoneNumbers
 * @package Plivo\Resources\Pricing
 */
class PhoneNumbers
{
    /**
     * @var Local
     */
    public $local; //Local
    /**
     * @var Tollfree
     */
    public $tollfree; //Tollfree

    /**
     * PhoneNumbers constructor.
     * @param Local $local
     * @param Tollfree $tollfree
     */
    function __construct(Local $local, Tollfree $tollfree)
    {
        $this->local = $local;
        $this->tollfree = $tollfree;
    }

    /**
     * @return Local
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * @return Tollfree
     */
    public function getTollfree()
    {
        return $this->tollfree;
    }


}