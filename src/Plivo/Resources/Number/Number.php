<?php

namespace Plivo\Resources\Number;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class Number
 * @package Plivo\Resources\Number
 * @property string $addedOn The date on which the number was rented on your account. The date format is YYYY-MM-DD
 * @property string $alias A friendly name for your Plivo number.
 * @property string $application The Plivo application linked to the number.
 * @property string $carrier The carrier which is linked to this number. This
 * can either be a Plivo carrier or a custom carrier added using the
 * IncomingCarrier API https://www.plivo.com/docs/api/incomingcarrier/
 * @property string $monthlyRentalRate The monthly rental for this number in USD.
 * @property string $number The phone number itself.
 * @property string $numberType The type of the number. The values can be 'local', 'tollfree' and 'national'
 * @property string $region The region, with the city and the country this number belongs to.
 * @property string $resourceUri
 * @property string $smsEnabled Lets you know if the number is SMS enabled. If the value returned is 'true', then you
 * will be able to receive SMS on this number.
 * @property string $smsRate The cost of receiving an SMS on the number in USD.
 * @property string $voiceEnabled Lets you know if the number is voice enabled. If the value returned is 'true', then
 * you will be able to receive calls on this number.
 * @property string $voiceRate The cost of receiving a voice call on this number per minute in USD.
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
            'addedOn' => $response['added_on'],
            'alias' => $response['alias'],
            'application' => $response['application'],
            'carrier' => $response['carrier'],
            'monthlyRentalRate' => $response['monthly_rental_rate'],
            'number' => $response['number'],
            'numberType' => $response['number_type'],
            'region' => $response['region'],
            'resourceUri' => $response['resource_uri'],
            'smsEnabled' => $response['sms_enabled'],
            'smsRate' => $response['sms_rate'],
            'subAccount' => $response['sub_account'],
            'voiceEnabled' => $response['voice_enabled'],
            'voiceRate' => $response['voice_rate']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'number' => $response['number']
        ];

        $this->id = $response['number'];
    }
}