<?php

namespace Plivo\Resources\Pricing;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class Pricing
 * @package Plivo\Resources\Pricing
 */
class Pricing extends Resource
{
    /**
     * Pricing constructor.
     * @param BaseClient $client
     * @param array $response
     */
    function __construct(BaseClient $client, $response)
    {
        parent::__construct($client);

        $this->id = $response['country_iso'];

        $this->properties = [
            'country' => $response['country'],
            'countryCode' => $response['country_code'],
            'countryIso' => $response['country_iso']
        ];

        $outboundNetworksList = [];

        foreach($response['message']['outbound_networks_list'] as $outboundNetwork){
            array_push(
                $outboundNetworksList,
                new OutboundNetwork(
                    $outboundNetwork['group_name'],
                    $outboundNetwork['rate'])
            );
        }

        $this->properties['message'] = new Message(
            new Inbound($response['message']['inbound']['rate']),
            new Outbound($response['message']['outbound']['rate']),
            $outboundNetworksList
        );

        $toll_free = isset($response['phone_numbers']['tollfree']['rate']) ? $response['phone_numbers']['tollfree']['rate']: null;
        $local     = isset($response['phone_numbers']['local']['rate']) ? $response['phone_numbers']['local']['rate']: null;

        $this->properties['phoneNumbers'] = new PhoneNumbers(
            new Local($local),
            new Tollfree($toll_free)
        );

        $this->properties['voice'] = new Voice(
            $response['voice']['inbound'],
            $response['voice']['outbound']
        );
    }
}

