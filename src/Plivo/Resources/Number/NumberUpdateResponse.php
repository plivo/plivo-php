<?php

namespace Plivo\Resources\Number;


use Plivo\Resources\ResponseUpdate;

/**
 * Class NumberUpdateResponse
 * @package Plivo\Resources\Number
 */
class NumberUpdateResponse extends ResponseUpdate
{

    /**
     * NumberUpdateResponse constructor.
     * @param $message
     * @param $newCNAM
     * @param $cnamUpdateStatus
     */
    public function __construct($apiId, $message, $newCNAM, $cnamUpdateStatus, $statusCode = 200)
    {
        parent::__construct($apiId, $message, $statusCode);

        if ($newCNAM !== null){
            $this->newCNAM = $newCNAM;
        }
        if ($cnamUpdateStatus !== null){
            $this->cnamUpdateStatus = $cnamUpdateStatus;
        }
    }


}