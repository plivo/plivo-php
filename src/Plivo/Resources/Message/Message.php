<?php

namespace Plivo\Resources\Message;


use Plivo\MessageClient;
use Plivo\Resources\Resource;

/**
 * Class Message
 * @package Plivo\Resources\Message
 * @property string $from
 * @property string $to
 * @property string $messageDirection
 * @property string $messageState
 * @property string $messageTime
 * @property string $messageType
 * @property string $messageUuid
 * @property string $resourceUri
 * @property string $totalAmount
 * @property string $totalRate
 * @property string $units
 * @property string $replacedSender
 * @property ?string $errorCode
 * @property ?string $powerpackID
 * @property ?string $requesterIP
 * @property ?bool $isDomestic
 */
class Message extends Resource
{
    /**
     * Message constructor.
     * @param MessageClient $client The Plivo API REST client
     * @param array $response
     * @param string $authId
     */
    public function __construct(
        MessageClient $client, $response, $authId, $uri)
    {
        parent::__construct($client);

        $this->properties = [
            'from' => $response['from_number'],
            'to' => $response['to_number'],
            'messageDirection' => $response['message_direction'],
            'messageState' => $response['message_state'],
            'messageTime' => $response['message_time'],
            'messageType' => $response['message_type'],
            'messageUuid' => $response['message_uuid'],
            'resourceUri' => $response['resource_uri'],
            'totalAmount' => $response['total_amount'],
            'totalRate' => $response['total_rate'],
            'units' => $response['units'],
            'destination_country_iso2' => $response['destination_country_iso2'],
            'replacedSender' => $response['replaced_sender']
        ];

        // handled empty string and null case
        if (!empty($response['api_id'])) {
            $this->properties['apiId'] = $response['api_id'];
        }
        if (!empty($response['powerpack_id'])) {
            $this->properties['powerpackID'] = $response['powerpack_id'];
        }
        if (!empty($response['error_code'])) {
            $this->properties['errorCode'] = $response['error_code'];
        }
        if (!empty($response['message_expiry'])) {
            $this->properties['messageExpiry'] = $response['message_expiry'];
        }

        if (!empty($response['requester_ip'])) {
            $this->properties['requesterIP'] = $response['requester_ip'];
        }

        if (!empty($response['tendlc_campaign_id'])) {
            $this->properties['tendlc_campaign_id'] = $response['tendlc_campaign_id'];
        }
        
        if (!empty($response['tendlc_registration_status'])) {
            $this->properties['tendlc_registration_status'] = $response['tendlc_registration_status'];
        }

        if (isset($response['is_domestic'])){
            $this->properties['isDomestic'] = $response['is_domestic'];
        }

        $this->pathParams = [
            'authId' => $authId,
            'messageUuid' => $response['message_uuid']
        ];

        $this->id = $response['message_uuid'];
        $this->uri = $uri;
    }
    // above PHP 5.6, it hides the other object info on output 
    public function __debugInfo() {
        return $this->properties;
    }

    public function listMedia(){
        $response = $this->client->fetch(
           $this->uri . $this->id .'/Media/',
           []
        );
       return $response->getContent();
   }

   public function deleteMedia(){
       return $response = $this->client->delete(
           $this->uri . $this->id .'/Media/',
           []
       );
   }

}
