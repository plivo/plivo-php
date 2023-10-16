<?php

namespace Plivo\Resources\VerifyCallerId;

use Plivo\Resources\ResponseUpdate;

/**
 * Class InitiateVerifyResponse
 * @package Plivo\Resources\VerifyCallerId
 */

class InitiateVerifyResponse extends ResponseUpdate{

    protected $verificationUuid;

    /**
     * Verify constructor.
     * @param string verificationUuid
     */

    public function __construct($apiID, $message, $verificationUuid, $statusCode)
    {
        parent::__construct($apiID, $message,$statusCode);

        $this->verificationUuid = $verificationUuid;
    }

    public function getVerificationUuid()
    {
        return $this->verificationUuid;
    }

    
}
