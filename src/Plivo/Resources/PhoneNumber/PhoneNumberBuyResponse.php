<?php

namespace Plivo\Resources\PhoneNumber;


use Plivo\Resources\ResponseUpdate;

/**
 * Class PhoneNumberBuyResponse
 * @package Plivo\Resources\PhoneNumber
 */
class PhoneNumberBuyResponse extends ResponseUpdate
{
    protected $number;
    protected $numberStatus;
    protected $status;

    /**
     * PhoneNumberBuyResponse constructor.
     * @param $message
     * @param $number
     * @param $numberStatus
     * @param $status
     */
    public function __construct($apiID, $message, $number, $numberStatus, $status,$statusCode)
    {
        parent::__construct($apiID, $message,$statusCode);

        $this->number = $number;
        $this->numberStatus = $numberStatus;
        $this->status = $status;
    }


}