<?php

namespace Plivo\Resources\Call;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class CallQueued
 * @package Plivo\Resources\Call
 */
class CallQueued extends Resource
{
    /**
     * CallQueued constructor.
     * @param BaseClient $client The Plivo API REST client
     * @param array $response
     * @param string $authId
     */
    function __construct(BaseClient $client, $response, $authId)
    {
        parent::__construct($client);

        $this->properties = [
            'direction' => $response['direction'],
            'from' => $response['from'],
            'callStatus' => $response['call_status'],
            'to' => $response['to'],
            'callName' => $response['caller_name'],
            'callUuid' => $response['call_uuid'],
            'requestUuid' => $response['request_uuid'],
            'apiID' => $response['api_id']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'callUuid' => $response['call_uuid']
        ];

        $this->id = $response['call_uuid'];
    }

    /**
     * Proxy the actions to the interface
     * @return null|CallInterface
     */
    public function proxyToInterface()
    {
        if (!$this->interface) {
            $this->interface = new CallInterface(
                $this->client, $this->pathParams['authId']);
        }

        return $this->interface;
    }

    /**
     * Cancel this call
     *
     * @return \Plivo\Resources\ResponseDelete
     */
    public function cancel()
    {
        return $this->proxyToInterface()->cancel($this->id);
    }
}