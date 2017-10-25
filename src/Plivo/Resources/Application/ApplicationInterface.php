<?php

namespace Plivo\Resources\Application;

use Plivo\Exceptions\PlivoValidationException;
use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResponseDelete;
use Plivo\Resources\ResponseUpdate;
use Plivo\Util\ArrayOperations;


/**
 * Class ApplicationInterface
 * @package Plivo\Resources\Application
 * @property ApplicationList list
 * @method ApplicationList list(array $optionalArgs)
 */
class ApplicationInterface extends ResourceInterface
{
    /**
     * ApplicationInterface constructor.
     * @param BaseClient $plivoClient
     * @param string $authId The authentication ID
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/Application/";
    }


    /**
     * Create a new application
     *
     * @param string $appName The name of your application
     * @param array $optionalArgs
     *   + Valid arguments with their types
     *   + string answer_url - The URL that will be notified by Plivo when the call is answered.
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
     * @return ApplicationCreateResponse
     */
    public function create(
        $appName, array $optionalArgs = [])
    {
        $mandaoryArgs = [
            'app_name' => $appName
        ];

        $response = $this->client->update(
            $this->uri,
            array_merge($mandaoryArgs, $optionalArgs)
        );

        $responseContents = $response->getContent();

        return new ApplicationCreateResponse(
            $responseContents['api_id'],
            $responseContents['message'],
            $responseContents['app_id']
        );
    }

    /**
     * Modify an application
     *
     * @param string $appId
     *
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
     * @return ResponseUpdate
     */
    public function update($appId, array $optionalArgs = [])
    {
        $response = $this->client->update(
            $this->uri . $appId . '/',
            $optionalArgs
        );

        $responseContents = $response->getContent();

        return new ResponseUpdate(
            $responseContents['message']);
    }

    /**
     * Delete an application
     * @param string $appId
     * @return ResponseDelete
     */
    public function delete($appId)
    {
        $response = $this->client->delete(
            $this->uri . $appId . '/',
            []
        );

        return new ResponseDelete($response->getStatusCode());
    }

    /**
     * Retrive an application
     * @param string $appId
     * @return Application
     * @throws PlivoValidationException
     */
    public function get($appId)
    {
        if (ArrayOperations::checkNull([$appId])) {
            throw
            new PlivoValidationException(
                'app id is mandatory');
        }

        $response = $this->client->fetch(
            $this->uri . $appId . '/',
            []
        );

        return new Application(
            $this->client,
            $response->getContent(),
            $this->pathParams['authId']);
    }


    /**
     * Retrieve a list of applications
     *
     * @param array $optionalArgs
     *   + Valid arguments
     *   + string subaccount - Id of the subaccount, in case only subaccount applications are needed.
     *   + integer limit - Used to display the number of results per page. The maximum number of results that can be fetched is 20.
     *   + integer offset - Denotes the number of value items by which the results should be offset. Eg:- If the result contains a 1000 values and limit is set to 10 and offset is set to 705, then values 706 through 715 are displayed in the results. This parameter is also used for pagination of the results.
     *
     * @return ApplicationList
     */
    public function getList(array $optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );

        $applications = [];

        foreach ($response->getContent()['objects'] as $application) {
            $newApplication = new Application(
                $this->client,
                $application,
                $this->pathParams['authId']);

            array_push($applications, $newApplication);
        }

        return new ApplicationList(
            $this->client,
            $response->getContent()['meta'],
            $applications);
    }
}