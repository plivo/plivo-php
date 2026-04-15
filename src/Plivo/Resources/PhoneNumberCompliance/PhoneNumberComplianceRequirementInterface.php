<?php

namespace Plivo\Resources\PhoneNumberCompliance;


use Plivo\Exceptions\PlivoResponseException;
use Plivo\BaseClient;

use Plivo\Resources\ResourceInterface;

/**
 * Class PhoneNumberComplianceRequirementInterface
 * @package Plivo\Resources\PhoneNumberCompliance
 */
class PhoneNumberComplianceRequirementInterface extends ResourceInterface
{
    /**
     * PhoneNumberComplianceRequirementInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/PhoneNumber/Compliance/Requirements/";
    }

    /**
     * This method lets you get the compliance requirements for phone numbers.
     * @param array $params
     * @return array
     */
    public function getList($params = [])
    {
        $response = $this->client->fetch(
            $this->uri,
            $params
        );

        if(!array_key_exists("error", $response->getContent())){
            return $response->getContent();
        } else {
            throw new PlivoResponseException(
                $response->getContent()['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }
}
