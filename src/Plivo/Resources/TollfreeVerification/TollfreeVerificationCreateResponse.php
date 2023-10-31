<?php

namespace Plivo\Resources\TollfreeVerification;


use Plivo\Resources\ResponseUpdate;

/**
 * Class TollfreeVerificationCreateResponse
 * @package Plivo\Resources\TollfreeVerification
 */
class TollfreeVerificationCreateResponse extends ResponseUpdate
{
    /**
     * @var string The uuid of the Tollfree Verification
     */
    public $uuid;


    /**
     * TollfreeVerificationCreateResponse constructor.
     * @param string $uuid
     * @param string $apiID
     * @param string $message
     */

    public function __construct($uuid, $message, $apiID, $statusCode)
    {
        parent::__construct($apiID, $message, $statusCode);

        $this->uuid = $uuid;
    }
}