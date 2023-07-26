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
     * @param $CnamUpdateStatus
     * @param $numberStatus
     * @param $status
     */
    public function __construct($apiID, $message, $number, $newCNAM, $CnamUpdateStatus, $numberStatus, $status, $statusCode)
    {
        parent::__construct($apiID, $message, $statusCode);

        $this->number = $number;
        if ($newCNAM !== null){
            $this->newCNAM = $newCNAM;
        }
        if ($CnamUpdateStatus !== null){
            $this->CnamUpdateStatus = $CnamUpdateStatus;
        }
        $this->numberStatus = $numberStatus;
        $this->status = $status;
    }


}