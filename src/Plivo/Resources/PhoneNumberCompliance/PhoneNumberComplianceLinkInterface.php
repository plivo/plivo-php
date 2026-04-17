<?php

namespace Plivo\Resources\PhoneNumberCompliance;


use Plivo\Exceptions\PlivoValidationException;
use Plivo\Exceptions\PlivoResponseException;
use Plivo\BaseClient;

use Plivo\Resources\ResourceInterface;
use Plivo\Util\ArrayOperations;

/**
 * Class PhoneNumberComplianceLinkInterface
 * @package Plivo\Resources\PhoneNumberCompliance
 */
class PhoneNumberComplianceLinkInterface extends ResourceInterface
{
    /**
     * PhoneNumberComplianceLinkInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/PhoneNumber/Compliance/Link/";
    }

    /**
     * Link numbers to a compliance
     * @param array $numbers
     * @return array
     * @throws PlivoValidationException
     * @throws PlivoResponseException
     */
    public function link(array $numbers)
    {
        if (ArrayOperations::checkNull($numbers)) {
            throw new PlivoValidationException(
                "numbers parameter cannot be null");
        }

        $response = $this->client->update(
            $this->uri,
            ['numbers' => $numbers]
        );

        $responseContents = $response->getContent();

        if(array_key_exists("error", $responseContents)){
            throw new PlivoResponseException(
                "",
                0,
                null,
                $responseContents,
                $response->getStatusCode()
            );
        }

        return $responseContents;
    }
}
