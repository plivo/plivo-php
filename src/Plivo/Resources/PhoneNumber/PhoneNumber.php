<?php

namespace Plivo\Resources\PhoneNumber;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class PhoneNumber
 * @package Plivo\Resources\PhoneNumber
 * @property string $city
 * @property string $country
 * @property string $lata
 * @property string $number
 * @property string $type
 * @property string $monthlyRentalRate
 * @property string $prefix
 * @property string $rateCenter
 * @property string $region
 * @property string $resourceUri
 * @property string $restriction
 * @property string $restrictionText
 * @property string $setupRate
 * @property string $smsEnabled
 * @property string $smsRate
 * @property string $mmsEnabled
 * @property string $mmsRate
 * @property string $complianceRequirement
 * @property string $voiceEnabled
 * @property string $voiceRate
 */
class PhoneNumber extends Resource
{
    /**
     * PhoneNumber constructor.
     * @param BaseClient $client The Plivo API REST client
     * @param array $response
     * @param string $authId
     */
    function __construct(BaseClient $client, array $response, $authId)
    {
        parent::__construct($client);

        $this->properties = [
            'city' => $response['city'],
            'country' => $response['country'],
            'lata' => $response['lata'],
            'number' => $response['number'],
            'type' => $response['type'],
            'monthlyRentalRate' => $response['monthly_rental_rate'],
            'prefix' => $response['prefix'],
            'rateCenter' => $response['rate_center'],
            'region' => $response['region'],
            'resourceUri' => $response['resource_uri'],
            'restriction' => $response['restriction'],
            'restrictionText' => $response['restriction_text'],
            'setupRate' => $response['setup_rate'],
            'smsEnabled' => $response['sms_enabled'],
            'smsRate' => $response['sms_rate'],
            'mmsEnabled' => $response['mms_enabled'],
            'mmsRate' => $response['mms_rate'],
            'voiceEnabled' => $response['voice_enabled'],
            'voiceRate' => $response['voice_rate'],
            'complianceRequirement' => $response['compliance_requirement']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'number' => $response['number']
        ];

        $this->id = $response['number'];
    }
}