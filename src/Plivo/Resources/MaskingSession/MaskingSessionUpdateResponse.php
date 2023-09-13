<?php

namespace Plivo\Resources\MaskingSession;

use Plivo\Resources\ResponseDelete;
use Plivo\Resources\ResponseUpdate;


/**
 * Class MaskingSessionCreateResponse
 * @package Plivo\Resources\MaskingSession
 */
class MaskingSessionUpdateResponse extends ResponseUpdate
{
    protected $session;

    /**
     * MaskingSessionUpdateResponse constructor.
     * @param $apiID
     * @param $message
     * @param $session
     * @param $statusCode
     */
    public function __construct($apiId, $message, $session, $statusCode )
    {
        parent::__construct($apiId, $message,$statusCode);
        $this->session = $session;
        
    }
    
    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }

}