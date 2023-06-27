<?php

namespace Plivo\Resources\Number;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class Number
 * @package Plivo\Resources\Number
 * @property string $addedOn The date on which the number was rented on your account. The date format is YYYY-MM-DD
 * @property boolean $active Whether this number is ready to be used by.
 * @property string $alias A friendly name for your Plivo number.
 * @property string $application The Plivo application linked to the number.
 * @property string $carrier The carrier which is linked to this number. This
 * can either be a Plivo carrier or a custom carrier added using the
 * IncomingCarrier API https://www.plivo.com/docs/api/incomingcarrier/
 * @property string $city The city this number belongs to.
 * @property string $country The country this number belongs to.
 * @property string $monthlyRentalRate The monthly rental for this number in USD.
 * @property string $number The phone number itself.
 * @property string $numberType The type of the number. The values can be 'local', 'tollfree' and 'national'
 * @property string $region The region, with the city and the country this number belongs to.
 * @property string $resourceUri
 * @property string $smsEnabled Lets you know if the number is SMS enabled. If the value returned is 'true', then you
 * will be able to receive SMS on this number.
 * @property string $smsRate The cost of receiving an SMS on the number in USD.
 * @property string $mmsEnabled Lets you know if the number is MMS enabled. If the value returned is 'true', then you
 * will be able to receive MMS on this number.
 * @property string $mmsRate The cost of receiving an MMS on the number in USD.
 * @property string $voiceEnabled Lets you know if the number is voice enabled. If the value returned is 'true', then
 * you will be able to receive calls on this number.
 * @property string $voiceRate The cost of receiving a voice call on this number per minute in USD.
 * @property string $complianceApplicationId The ID of compliance application associated with this number.
 * @property string $complianceStatus The status of the compliance application associated with this number.
 * @property string $subAccount The subaccount associated with the number. If the number belongs to the main parent
 * account, this value will be null.
 */
class Number extends Resource
{
    /**
     * Number constructor.
     * @param BaseClient $client The Plivo API REST client
     * @param array $response
     * @param string $authId
     */
    function __construct(BaseClient $client, array $response, $authId)
    {
        parent::__construct($client);

        $this->properties = [
            'active' => $response['active'],
            'addedOn' => $response['added_on'],
            'alias' => $response['alias'],
            'application' => $response['application'],
            'carrier' => $response['carrier'],
            'city' => isset($response['city']) ? $response['city'] : null,
            'country' => isset($response['country']) ? $response['country'] : null,
            'monthlyRentalRate' => $response['monthly_rental_rate'],
            'number' => $response['number'],
            'numberType' => $response['number_type'],
            'region' => $response['region'],
            'resourceUri' => $response['resource_uri'],
            'smsEnabled' => $response['sms_enabled'],
            'smsRate' => $response['sms_rate'],
            'mmsEnabled' => isset($response['mms_enabled']) ? $response['mms_enabled'] : null,
            'mmsRate' => isset($response['mms_rate']) ? $response['mms_rate'] : null,
            'subAccount' => $response['sub_account'],
            'voiceEnabled' => $response['voice_enabled'],
            'voiceRate' => $response['voice_rate'],
            'complianceApplicationId' => isset($response['compliance_application_id']) ? $response['compliance_application_id'] : null,
            'complianceStatus' => isset($response['compliance_status']) ? $response['compliance_status'] : null,
            'tendlcCampaignId' => $response['tendlc_campaign_id'],
            'tendlcRegistrationStatus' => $response['tendlc_registration_status'],
            'tollFreeSMSVerification' => $response['toll_free_sms_verification'],
            'renewalDate' => $response['renewal_date'],
            'cnamLookup' => isset($response['cnam_lookup']) ? $response['cnam_lookup'] : null,
        ];
        $this->pathParams = [
            'authId' => $authId,
            'number' => $response['number']
        ];

        $this->id = $response['number'];
    }
}
