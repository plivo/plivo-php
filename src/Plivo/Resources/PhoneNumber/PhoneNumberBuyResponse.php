<?php

namespace Plivo\Resources\PhoneNumber;


use Plivo\Resources\ResponseUpdate;

/**
 * Class PhoneNumberBuyResponse
 * @package Plivo\Resources\PhoneNumber
 */
class PhoneNumberBuyResponse extends ResponseUpdate
{
    public $number;
    public $numberStatus;
    public $status;
    public $fallbackNumber;

    /**
     * PhoneNumberBuyResponse constructor.
     * @param $apiID
     * @param $message
     * @param $number
     * @param $numberStatus
     * @param $status
     * @param $statusCode
     * @param $fallbackNumber
     */
    public function __construct($apiID, $message, $number, $numberStatus, $status, $statusCode, $fallbackNumber = null)
    {
        parent::__construct($apiID, $message, $statusCode);

        $this->number = $number;
        $this->numberStatus = $numberStatus;
        $this->status = $status;
        $this->fallbackNumber = $fallbackNumber;
    }


}