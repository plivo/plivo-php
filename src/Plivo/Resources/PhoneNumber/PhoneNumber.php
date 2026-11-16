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
 * @property ?string $monthlyRentalRateINR INR accounts only, else null
 * @property string $prefix
 * @property string $rateCenter
 * @property string $region
 * @property string $resourceUri
 * @property string $restriction
 * @property string $restrictionText
 * @property string $setupRate
 * @property ?string $setupRateINR INR accounts only, else null
 * @property string $smsEnabled
 * @property string $smsRate
 * @property ?string $smsRateINR INR accounts only, else null
 * @property string $mmsEnabled
 * @property string $mmsRate
 * @property ?string $mmsRateINR INR accounts only, else null
 * @property string $complianceRequirement
 * @property string $voiceEnabled
 * @property string $voiceRate
 * @property ?string $voiceRateINR INR accounts only, else null
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
            'monthlyRentalRateINR' => isset($response['monthly_rental_rate_inr']) ? $response['monthly_rental_rate_inr'] : null,
            'prefix' => $response['prefix'],
            'rateCenter' => $response['rate_center'],
            'region' => $response['region'],
            'resourceUri' => $response['resource_uri'],
            'restriction' => $response['restriction'],
            'restrictionText' => $response['restriction_text'],
            'setupRate' => $response['setup_rate'],
            'setupRateINR' => isset($response['setup_rate_inr']) ? $response['setup_rate_inr'] : null,
            'smsEnabled' => $response['sms_enabled'],
            'smsRate' => $response['sms_rate'],
            'smsRateINR' => isset($response['sms_rate_inr']) ? $response['sms_rate_inr'] : null,
            'mmsEnabled' => $response['mms_enabled'],
            'mmsRate' => $response['mms_rate'],
            'mmsRateINR' => isset($response['mms_rate_inr']) ? $response['mms_rate_inr'] : null,
            'voiceEnabled' => $response['voice_enabled'],
            'voiceRate' => $response['voice_rate'],
            'voiceRateINR' => isset($response['voice_rate_inr']) ? $response['voice_rate_inr'] : null,
            'complianceRequirement' => $response['compliance_requirement']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'number' => $response['number']
        ];

        $this->id = $response['number'];
    }
}