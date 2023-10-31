<?php

namespace Plivo\Resources\TollfreeVerification;


use Plivo\Exceptions\PlivoValidationException;
use Plivo\Exceptions\PlivoResponseException;
use Plivo\BaseClient;

use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResourceList;

use Plivo\Resources\ResponseUpdate;
use Plivo\Util\ArrayOperations;

/**
 * Class TollfreeVerificationInterface
 * @package Plivo\Resources\TollfreeVerification
 * @property ResourceList $list
 * @method ResourceList list(array $optionalArgs)
 */
class TollfreeVerificationInterface extends ResourceInterface
{
    /**
     * EndUserInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/TollfreeVerification/";
    }


    /**
     * This method lets you create a new TollfreeVerification entry
     * @param string $number
     * @param string $usecase
     * @param string $profile_uuid
     * @param string $optin_type
     * @param string $volume
     * @param string $usecase_summary
     * @param string $message_sample
     * @param string $optin_image_url
     * @param null|string $callback_url
     * @param null|string $callback_method
     * @param null|string $additional_information
     * @param null|string $extra_data
     * @return JSON output
     * @throws PlivoValidationException
     */
    public function create($number, $usecase, $profile_uuid, $optin_type, $volume, $usecase_summary, $message_sample, $optin_image_url, $callback_url = null, $callback_method = null, $additional_information = null, $extra_data = null)
    {
        $mandatoryArgs = [
            'number' => $number,
            'usecase' => $usecase,
            'profile_uuid' => $profile_uuid,
            'optin_type' => $optin_type,
            'volume' => $volume,
            'usecase_summary' => $usecase_summary,
            'message_sample' => $message_sample,
            'optin_image_url' => $optin_image_url,
        ];

        if (ArrayOperations::checkNull($mandatoryArgs)) {
            throw new PlivoValidationException(
                "Mandatory parameters cannot be null");
        }

        $response = $this->client->update(
            $this->uri,
            array_merge($mandatoryArgs, ['callback_url' => $callback_url, 'callback_method' => $callback_method,
            'additional_information' => $additional_information, 'extra_data' => $extra_data])
        );
        $responseContents = $response->getContent();
        if(!array_key_exists("error", $responseContents)){

            return new TollfreeVerificationCreateResponse(
                $responseContents['uuid'],
                $responseContents['message'],
                $responseContents['api_id'],
                $response->getStatusCode()
            );
        } else {
            throw new PlivoResponseException(
                "",
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * This method lets you get details of a single TollfreeVerification on your account using the $uuid.
     * @param $uuid
     * @return TollfreeVerification
     * @throws PlivoValidationException
     */
    public function get($uuid)
    {
        if (ArrayOperations::checkNull([$uuid])) {
            throw
            new PlivoValidationException(
                'uuid is mandatory');
        }
        $response = $this->client->fetch(
            $this->uri . $uuid .'/',
            []
        );

        if(!array_key_exists("error", $response->getContent())){
            return new TollfreeVerification(
                $this->client, $response->getContent(),
                $this->pathParams['authId']
            );
        } else {
            throw new PlivoResponseException(
                $response->getContent()['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }

    /**
    * This method lets you get details of all TollfreeVerification numbers.
    * @param array $optionalArgs
    *   + Valid arguments
    *   + [string] number - The type of number you are filtering. You can filter by tollfree numbers.
    *   + [string] profile_uuid - This is the uuid of the profile.
    *   + [string] status - This is the status of verification number.
    *   + [int] limit - Used to display the number of results per page. The maximum number of results that can be fetched is 20.
    *   + [int] offset - Denotes the number of value items by which the results should be offset. Eg:- If the result contains a 1000 values and limit is set to 10 and offset is set to 705, then values 706 through 715 are displayed in the results. This parameter is also used for pagination of the results.
    *   + [string] created__gt - Used to filter on the basis of this param. If this parameter is included in the request, all numbers greater than created date are displayed.
    *   + [string] created__gte - Used to filter on the basis of this param. If this parameter is included in the request, all numbers greater than equal created date are displayed.
    *   + [string] created__lt - Used to filter on the basis of this param. If this parameter is included in the request, all numbers less than created date are displayed.
    *   + [string] created__lte - Used to filter on the basis of this param. If this parameter is included in the request, all numbers less than equal created date are displayed.
    * @return ResourceList
    */
    public function getList($optionalArgs = [])
    {
//     print_r($this->uri);
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );

        if(!array_key_exists("error", $response->getContent())){
            $tollfreeVericationObj = [];
            foreach ($response->getContent()['objects'] as $tollfreeVerification) {
                $newTfObj = new TollfreeVerification($this->client, $tollfreeVerification, $this->pathParams['authId']);
                array_push($tollfreeVericationObj, $newTfObj);
            }
            return new ResourceList($this->client, $response->getContent()['meta'], $tollfreeVericationObj);
        } else {
            throw new PlivoResponseException(
                $response->getContent()['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * Modify an TollfreeVerification
     *
     * @param $uuid
     * @param array $optionalArgs
     *   + Valid arguments
     *   + [string] profile_uuid - The profile_uuid of your TollfreeVerification.
     *   + [string] usecase - The usecase of your TollfreeVerification.
     *   + [string] usecase_summary - The usecase summary of the TollfreeVerification.
     *   + [string] message_sample - The message sample of the TollfreeVerification.
     *   + [string] optin_image_url - The optin image url of the TollfreeVerification.
     *   + [string] optin_type - The optin type of the TollfreeVerification.
     *   + [string] volume - The volume of the TollfreeVerification.
     *   + [string] additional_information - The additional information of the TollfreeVerification.
     *   + [string] extra_data - The extra data of the TollfreeVerification.
     *   + [string] callback_url - The callback url of the TollfreeVerification.
     *   + [string] callback_method - The callback method of the TollfreeVerification.
     * @return ResponseUpdate
     */
    public function update($uuid, array $optionalArgs = [])
    {
        $response = $this->client->update(
            $this->uri . $uuid . '/',
            $optionalArgs
        );

        $responseContents = $response->getContent();

        if(!array_key_exists("error",$responseContents)){
            return new ResponseUpdate(
                $responseContents['api_id'],
                $responseContents['message'],
                $response->getStatusCode()
            );
        } else {
            throw new PlivoResponseException(
                "",
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * Delete an TollfreeVerification
     *
     * @param $uuid
     * @throws PlivoValidationException
     */
    public function delete($uuid)
    {
        if (ArrayOperations::checkNull([$uuid])) {
            throw
            new PlivoValidationException(
                'uuid is mandatory');
        }
        $response = $this->client->delete(
            $this->uri . $uuid . '/',
            []
        );
        if(array_key_exists("error", $response->getContent()) && strlen($response->getContent()['error']) > 0) {
            throw new PlivoResponseException(
                $response->getContent()['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }
}
