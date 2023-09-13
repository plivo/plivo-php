<?php

namespace Plivo\Resources\MaskingSession;

use Plivo\Resources\ResponseUpdate;


/**
 * Class MaskingSessionCreateResponse
 * @package Plivo\Resources\MaskingSession
 */
class MaskingSessionCreateResponse extends ResponseUpdate
{
    protected $sessionUuid;
    protected $virtualNumber;
    protected $session;

    /**
     * MaskingSessionCreateResponse constructor.
     * @param $apiID
     * @param $sessionUuid
     * @param $virtualNumber
     * @param $message
     * @param $session
     * @param $statusCode
     */
    public function __construct($apiId, $sessionUuid, $virtualNumber, $message, $session, $statusCode )
    {
        parent::__construct($apiId, $message,$statusCode);
        $this->sessionUuid = $sessionUuid;
        $this->virtualNumber = $virtualNumber;
        $this->session = $session;
        
    }

    /**
     * @return mixed
     */
    public function getSessionUuid()
    {
        return $this->sessionUuid;
    }
    
    /**
     * @return mixed
     */
    public function getVirtualNumber()
    {
        return $this->virtualNumber;
    }
    
    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }




}