<?php

namespace Plivo\Resources\Account;

use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class Account
 * @package Plivo\Resources
 * @property string $accountType The type of your Plivo account. All accounts
 * with funds are standard accounts. If your account is on free trial, this
 * attribute will return developer.
 * @property string $address The postal address of the account which will be
 * reflected in the invoices.
 * @property string $authId The auth id of the account.
 * @property string $autoRecharge Auto recharge settings associated with the
 * account. If this value is true, we will recharge your account if the credits
 * fall below a certain threshold.
 * @property string $billingMode The billing mode of the account. Can be
 * prepaid or postpaid.
 * @property string $cashCredits Credits of the account.
 * @property string $city The city of the account.
 * @property string $name The name of the account holder.
 * @property string $resourceUri The resource URI.
 * @property string $state The state of the account holder.
 * @property string $timezone The timezone of the account. A list of timezones
 * possible timezone values are located at IANA Timezones
 * http://en.wikipedia.org/wiki/List_of_IANA_time_zones
 */
class Account extends Resource
{
    /**
     * Account constructor.
     * @param BaseClient $client The Plivo api REST client
     * @param array $response Decoded response
     * @param string $authId The authentication ID
     */
    public function __construct(BaseClient $client, $response, $authId)
    {
        parent::__construct($client);
        $this->properties = [
            'accountType' => $response['account_type'],
            'address' => $response['address'],
            'authId' => $response['auth_id'],
            'autoRecharge' => $response['auto_recharge'],
            'billingMode' => $response['billing_mode'],
            'cashCredits' => $response['cash_credits'],
            'city' => $response['city'],
            'name' => $response['name'],
            'resourceUri' => $response['resource_uri'],
            'state' => $response['state'],
            'timezone' => $response['timezone']
        ];

        $this->pathParams = [
            'authId' => $authId
        ];

        $this->id = $authId;
    }

}