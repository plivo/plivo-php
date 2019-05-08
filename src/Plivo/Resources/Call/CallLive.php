<?php

namespace Plivo\Resources\Call;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class CallLive
 * @package Plivo\Resources\Call
 */
class CallLive extends Resource
{
    /**
     * CallLive constructor.
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
            'sessionStart' => $response['session_start']
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
     * Tranfer this call
     * @param $optionalArgs
     * @return \Plivo\Resources\ResponseUpdate
     */
    public function transfer($optionalArgs)
    {
        return $this->proxyToInterface()->transfer(
            $this->id, $optionalArgs);
    }

    /**
     * Start recording this call
     * @param $optionalArgs
     * @return CallRecording
     */
    public function record($optionalArgs)
    {
        return $this->startRecording($optionalArgs);
    }

    /**
     * Start recording this call
     * @param $optionalArgs
     * @return CallRecording
     */
    public function startRecording($optionalArgs)
    {
        return $this->proxyToInterface()->startRecording(
            $this->id, $optionalArgs);
    }

    /**
     * Stop recording this call
     * @return \Plivo\Resources\ResponseDelete
     */
    public function stopRecording()
    {
        return $this->proxyToInterface()->stopRecording(
            $this->id);
    }

    /**
     * Start playing audio in this call
     *
     * @param $urls
     * @param $optionalArgs
     * @return \Plivo\Resources\ResponseUpdate
     */
    public function play($urls, $optionalArgs)
    {
        return $this->startPlaying($urls, $optionalArgs);
    }

    /**
     * Start playing audio in this call
     * @param $urls
     * @param $optionalArgs
     * @return \Plivo\Resources\ResponseUpdate
     */
    public function startPlaying($urls, $optionalArgs)
    {
        return $this->proxyToInterface()->startPlaying(
            $this->id, $urls, $optionalArgs);
    }

    /**
     * Stop playing audio in this call
     * @return \Plivo\Resources\ResponseDelete
     */
    public function stopPlaying()
    {
        return $this->proxyToInterface()->stopPlaying(
            $this->id);
    }

    /**
     * Start speaking text in this call
     * @param $text
     * @param $optionalArgs
     * @return \Plivo\Resources\ResponseUpdate
     */
    public function speak($text, $optionalArgs)
    {
        return $this->startSpeaking($text, $optionalArgs);
    }

    /**
     * Start speaking text in this call
     * @param $text
     * @param $optionalArgs
     * @return \Plivo\Resources\ResponseUpdate
     */
    public function startSpeaking($text, $optionalArgs)
    {
        return $this->proxyToInterface()->startSpeaking(
            $this->id, $text, $optionalArgs);
    }

    /**
     * Stop speaking text in this call
     *
     * @return \Plivo\Resources\ResponseDelete
     */
    public function stopSpeaking()
    {
        return $this->proxyToInterface()->stopSpeaking(
            $this->id);
    }

    /**
     * Send digits in this call
     *
     * @param $digits
     * @param null $leg
     */
    public function dtmf($digits, $leg = null)
    {
        $this->proxyToInterface()->dtmf(
            $this->id, $digits, $leg);
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