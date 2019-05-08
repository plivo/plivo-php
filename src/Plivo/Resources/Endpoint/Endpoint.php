<?php

namespace Plivo\Resources\Endpoint;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class Endpoint
 * @package Plivo\Resources\Endpoint
 * @property string $alias Friendly name for your endpoint.
 * @property string $application The associated applicaption
 * @property string $endpointId A unique ID for your endpoint. All API operations will be performed with this ID.
 * @property string $resourceUri the resource URI
 * @property boolean $sipRegistered true if the SIP endpoint is registered on a SIP client.
 * @property string $password Passward
 * @property string $sipUri The SIP URI of the endpoint. External users will be able to call this endpoint on this SIP URI.
 * @property string $sipContact The contact field contains the address at which the callee can reach the caller for future requests. It is the IP on which the SIP client is registered.
 * @property string $sipExpires Time when the SIP registration will expire. Major SIP clients, Plivo WebSDK and Plivo mobile SDKs will re-register the endpoint before the registration expires.
 * @property string $sipUserAgent The User Agent of SIP client used to register this endpoint. In the case of WebSDK this field will be plivo-websdk.
 * @property string $subAccount The sub account in your Plivo account, if this endpoint belongs to a Plivo sub account.
 * @property string $username Username of your endpoint. Plivo appends a 12 digit code in front your username.
 */
class Endpoint extends Resource
{
    /**
     * Endpoint constructor.
     * @param BaseClient $client
     * @param array $response
     * @param string $authId
     */
    function __construct(BaseClient $client, $response, $authId)
    {
        parent::__construct($client);

        if ($response['sip_registered'] === 'true') {
            $this->properties['sipContact'] = $response['sip_contact'];
            $this->properties['sipExpires'] = $response['sip_expires'];
            $this->properties['sipUserAgent'] = $response['sip_user_agent'];
        } else {
            $this->properties['password'] =
                isset($response['password']) ? $response['password'] : "";
        }

        $this->properties = [
            'alias' => $response['alias'],
            'application' => $response['application'],
            'endpointId' => $response['endpoint_id'],
            'resourceUri' => $response['resource_uri'],
            'sipRegistered' => $response['sip_registered'],
            'sipUri' => $response['sip_uri'],
            'subAccount' => $response['sub_account'],
            'username' => $response['username']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'endpointId' => $response['endpoint_id']
        ];

        $this->id = $response['endpoint_id'];
    }
}