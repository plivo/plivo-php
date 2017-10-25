<?php

namespace Plivo\Resources\Application;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class Application
 * @package Plivo\Resources\Application
 * @property string $answerMethod The HTTP method which will be used to request
 * the answer_url when an incoming call is answered on the number or the
 * endpoint attached to the application.
 * @property string $answerUrl On receiving an incoming call on a number of an
 * endpoint attached to the application, Plivo will send a request to the
 * answer_url with the attributes of the call. We expect a valid Plivo XML to
 * be returned as a response to the request Plivo makes.
 * @property string $appId
 * @property string $appName A friendly name for your Plivo application.
 * @property string $defaultApp Default app
 * @property boolean $enabled Set to true if the application is enabled.
 * @property string $fallbackAnswerUrl Plivo will request this URL with the
 * same parameters sent to the answer_url if the answer_url returns a non 200
 * HTTP status code.
 * @property string $fallbackMethod The HTTP method which will be used to
 * request the fallback_answer_url when the answer_url returns a non 200 HTTP
 * status code.
 * @property string $hangupUrl When the incoming call is hung up on a number
 * or an endpoint attached to the application, Plivo will send a request to the
 * $hangupUrl with the attributes of the call.
 * @property string $hangupMethod The HTTP method which will be used to request
 * the $hangupUrl when an incoming call is hung up on the number or the endpoint
 * attached to the application.
 * @property string $messageUrl When an incoming message (SMS) is received to a
 * number attached to the application, Plivo will make a request to the
 * $messageUrl with the parameters documented here.
 * @property string $messageMethod The HTTP method which will be used to request
 * the message_url when an incoming message (SMS) is received on the number
 * attached to the application.
 * @property string $publicUri Set to true is the application can be called from
 * an external SIP service. By default the application is not public, and
 * external SIP services cannot call your application SIP URI.
 * @property string $sipUri The SIP URI of the application. All Plivo
 * applications can be called directly without attaching them to a number or an
 * endpoint. When an incoming call is received on this URI, Plivo will follow
 * the same flow as it does with a number or an endpoint.
 * @property string|null $subAccount The subaccount associated with the
 * application. If the application belongs to the main account, this field will
 * be null
 */
class Application extends Resource
{
    /**
     * Application constructor.
     * @param BaseClient $client
     * @param $response
     * @param $authId
     */
    public function __construct(BaseClient $client, $response, $authId)
    {
        parent::__construct($client);

        $this->properties = [
            'answerMethod' => $response['answer_method'],
            'answerUrl' => $response['answer_url'],
            'appId' => $response['app_id'],
            'appName' => $response['app_name'],
            'defaultApp' => $response['default_app'],
            'enabled' => $response['enabled'],
            'fallbackAnswerUrl' => $response['fallback_answer_url'],
            'fallbackMethod' => $response['fallback_method'],
            'hangupUrl' => $response['hangup_url'],
            'hangupMethod' => $response['hangup_method'],
            'messageMethod' => $response['message_method'],
            'messageUrl' => $response['message_url'],
            'publicUri' => $response['public_uri'],
            'resourceUri' => $response['resource_uri'],
            'sipUri' => $response['sip_uri'],
            'subAccount' => $response['sub_account']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'appId' => $response['app_id']
        ];

        $this->id = $response['app_id'];
    }

    /**
     * Proxy to the interface to actually execute the request
     * @return null|ApplicationInterface
     */
    public function proxyToInterface()
    {
        if ($this->interface) {
            $this->interface =
                new ApplicationInterface(
                    $this->client, $this->pathParams['authId']);
        }

        return $this->interface;
    }

    /**
     * Modify this application
     * @param array $optionalArgs
     *   + Valid arguments with their types
     *   + string answer_url - The URL invoked by Plivo when a call executes this application.
     *   + string answer_method - The method used to call the answer_url. Defaults to POST.
     *   + string hangup_url - The URL that will be notified by Plivo when the call hangs up. Defaults to answer_url.
     *   + string hangup_method - The method used to call the hangup_url. Defaults to POST.
     *   + string fallback_answer_url - Invoked by Plivo only if answer_url is unavailable or the XML response is invalid. Should contain a XML response.
     *   + string fallback_method - The method used to call the fallback_answer_url. Defaults to POST.
     *   + string message_url - The URL that will be notified by Plivo when an inbound message is received. Defaults not set.
     *   + string message_method - The method used to call the message_url. Defaults to POST.
     *   + boolean default_number_app - If set to true, this parameter ensures that newly created numbers, which don't have an app_id, point to this application.
     *   + boolean default_endpoint_app - If set to true, this parameter ensures that newly created endpoints, which don't have an app_id, point to this application.
     *   + string subaccount - Id of the subaccount, in case only subaccount applications are needed.
     *
     * @return \Plivo\Resources\ResponseUpdate
     */
    public function update(array $optionalArgs = [])
    {
        return $this->proxyToInterface()->update(
            $this->pathParams['appId'], $optionalArgs);
    }

    /**
     * Delete this application
     * @return \Plivo\Resources\ResponseDelete
     */
    public function delete()
    {
        return $this->proxyToInterface()->delete($this->pathParams['appId']);
    }
}