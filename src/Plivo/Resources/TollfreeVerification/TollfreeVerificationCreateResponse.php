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
     * @var string The api_id of the Tollfree Verification
     */
    public api_id;
    /**
     * @var string The message of the Tollfree Verification
     */
    public $message;
    /**
     * @var string The uuid of the Tollfree Verification
     */
    public $uuid;


    /**
     * TollfreeVerificationCreateResponse constructor.
     * @param string $uuid
     */

    public function __construct($uuid)
    {
        parent::__construct($apiID, $message, $statusCode);

        $this->uuid = $uuid;
    }
}