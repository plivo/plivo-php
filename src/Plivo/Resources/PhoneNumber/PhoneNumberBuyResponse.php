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

    /**
     * PhoneNumberBuyResponse constructor.
     * @param $message
     * @param $number
     * @param $newCNAM
     * @param $cnamUpdateStatus
     * @param $numberStatus
     * @param $status
     */
    public function __construct($apiID, $message, $number, $newCNAM, $cnamUpdateStatus, $numberStatus, $status, $statusCode)
    {
        parent::__construct($apiID, $message, $statusCode);

        $this->number = $number;
        if ($newCNAM !== null){
            $this->newCNAM = $newCNAM;
        }
        if ($cnamUpdateStatus !== null){
            $this->cnamUpdateStatus = $cnamUpdateStatus;
        }
        $this->numberStatus = $numberStatus;
        $this->status = $status;
    }


}