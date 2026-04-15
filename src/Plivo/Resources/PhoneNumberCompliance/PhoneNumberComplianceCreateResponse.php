<?php

namespace Plivo\Resources\PhoneNumberCompliance;


use Plivo\Resources\ResponseUpdate;

/**
 * Class PhoneNumberComplianceCreateResponse
 * @package Plivo\Resources\PhoneNumberCompliance
 */
class PhoneNumberComplianceCreateResponse extends ResponseUpdate
{
    /**
     * @var string The ID of the compliance
     */
    public $complianceId;

    /**
     * PhoneNumberComplianceCreateResponse constructor.
     * @param string $complianceId
     * @param string $message
     * @param string $apiID
     * @param string $statusCode
     */
    public function __construct($complianceId, $message, $apiID, $statusCode)
    {
        parent::__construct($apiID, $message, $statusCode);
        $this->complianceId = $complianceId;
    }

    /**
     * Get the compliance ID
     * @return string
     */
    public function getComplianceId()
    {
        return $this->complianceId;
    }
}
