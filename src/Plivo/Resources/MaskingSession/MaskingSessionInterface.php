<?php

namespace Plivo\Resources\MaskingSession;

use Plivo\Exceptions\PlivoValidationException;
use Plivo\Exceptions\PlivoResponseException;
use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResourceList;

use Plivo\Resources\ResponseUpdate;
use Plivo\Util\ArrayOperations;


/**
 * Class MaskingSessionInterface
 * @package Plivo\Resources\MaskingSession
 */
class MaskingSessionInterface extends ResourceInterface
{
    /**
     * MaskingSession Interface constructor.
     * @param BaseClient $plivoClient
     * @param string $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/Masking/Session/";
    }

     /**
     * Create a masking session
     * @method
     * @param {string} firstParty - The phone number or SIP endpoint of the first party.
     * @param {string} secondParty - The phone number or SIP endpoint of the second party.
     * @param array $optionalArgs
     *   + Valid arguments with their types
     *   + [number] sessionExpiry - The duration in seconds for which the masking session will be active.
     *   + [number] callTimeLimit - The maximum duration in seconds for each call in the masking session.
     *   + [boolean] record - Indicates whether the calls in the masking session should be recorded.
     *   + [string] recordFileFormat - The file format for the recorded calls.
     *   + [string] recordingCallbackUrl - The URL to which the recording callback will be sent.
     *   + [boolean] initiateCallToFirstParty - Indicates whether the call to the first party should be initiated automatically.
     *   + [string] callbackUrl - The URL to which the callback for the masking session will be sent.
     *   + [string] callbackMethod] - The HTTP method for the callback request.
     *   + [number] ringTimeout - The duration in seconds for which the call will ring before being canceled.
     *   + [string] firstPartyPlayUrl - The URL to play audio to the first party when the call is established.
     *   + [string] secondPartyPlayUrl - The URL to play audio to the second party when the call is established.
     *   + [string] recordingCallbackMethod - The HTTP method for the recording callback request.
     *   + [boolean] IsPinAuthenticationRequired - Indicates we need to authenticate pin or not.
     *   + [boolean] GeneratePin - Indicates we need to generate pin or not.
     *   + [number] GeneratePinLength - Pin length, by default = 4.
     *   + [string] FirstPartyPin - First Party Pin.
     *   + [string] SecondPartyPin - Second Party Pin.
     *   + [string] PinPromptPlay - Sound url to play during pin prompt.
     *   + [number] PinRetry - No of times retry allowed for wrong/invalid pin.
     *   + [number] PinRetryWait - Wait between consecutive retry.
     *   + [string] IncorrectPinPlay - Sound url to play when wrong/invalid pin entered.
     *   + [string] UnknownCallerPlay - Sound url to play for unknown caller.
     
     * @return JSON output
     * @throws PlivoValidationException,PlivoResponseException
     */
     public function createMaskingSession($firstParty, $secondParty,
                           array $optionalArgs = [])
    {
        $mandatoryArgs = [
            'first_party' => $firstParty,
            'second_party' => $secondParty,
        ];
        $optionalArgs['isVoiceRequest'] = true;

        if (ArrayOperations::checkNull($mandatoryArgs)) {
            throw new PlivoValidationException(
                "Mandatory parameters cannot be null");
        }


        $response = $this->client->update(
            $this->uri,
            array_merge($mandatoryArgs, $optionalArgs)
        );

        $responseContents = $response->getContent();
        if(!array_key_exists("error",$responseContents)){
            return new MaskingSessionCreateResponse(
                $responseContents['api_id'],
                $responseContents['session_uuid'],
                $responseContents['virtual_number'],
                $responseContents['message'],
                $responseContents['session'], 
                $response->getStatusCode()
            );
        } else {
            throw new PlivoResponseException(
                $responseContents['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()

            );
        }
        
    }

    /**
     * delete a masking session. 
     * @param string $sessionUuid
     * @throws PlivoValidationException
     */
    public function deleteMaskingSession($sessionUuid)
    {
        if (ArrayOperations::checkNull([$sessionUuid])) {
            throw
            new PlivoValidationException(
                'session uuid is mandatory');
        }
        $optionalArgs['isVoiceRequest'] = true;
        return $this->client->delete(
            $this->uri . $sessionUuid . '/',
            $optionalArgs
        );
        
    }

    /**
     * Get details of a masking session
     * @param string $sessionUuid
     * @throws PlivoValidationException
     */
    public function getMaskingSession($sessionUuid)
    {
        if (ArrayOperations::checkNull([$sessionUuid])) {
            throw
            new PlivoValidationException(
                'session uuid is mandatory');
        }
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->fetch(
            $this->uri . $sessionUuid . '/',
            $optionalArgs
        );

        return new MaskingSession(
            $this->client,
            $response->getContent(),
            $this->pathParams['authId']);
    }

    /**
     * Update a masking session
     * @method
     * @param {string} sessionUuid
     *
     * @param array $optionalArgs
     *   + Valid arguments with their types
     *   + [number] sessionExpiry - The duration in seconds for which the masking session will be active.
     *   + [number] callTimeLimit - The maximum duration in seconds for each call in the masking session.
     *   + [boolean] record - Indicates whether the calls in the masking session should be recorded.
     *   + [string] recordFileFormat - The file format for the recorded calls.
     *   + [string] recordingCallbackUrl - The URL to which the recording callback will be sent.
     *   + [string] callbackUrl - The URL to which the callback for the masking session will be sent.
     *   + [string] callbackMethod] - The HTTP method for the callback request.
     *   + [number] ringTimeout - The duration in seconds for which the call will ring before being canceled.
     *   + [string] firstPartyPlayUrl - The URL to play audio to the first party when the call is established.
     *   + [string] secondPartyPlayUrl - The URL to play audio to the second party when the call is established.
     *   + [string] recordingCallbackMethod - The HTTP method for the recording callback request.
     
     * @return ResponseUpdate
     * @throws PlivoValidationException,PlivoResponseException
     */
     public function updateMaskingSession($sessionUuid,
                           array $optionalArgs = [])
    {
        if (ArrayOperations::checkNull([$sessionUuid])) {
            throw
            new PlivoValidationException(
                'session uuid is mandatory');
        }
        $optionalArgs['isVoiceRequest'] = true;

        $response = $this->client->update(
            $this->uri . $sessionUuid . '/',
            $optionalArgs
        );

        $responseContents = $response->getContent();

        if(!array_key_exists("error",$responseContents)){
            return new MaskingSessionUpdateResponse(
                $responseContents['api_id'],
                $responseContents['message'],
                $responseContents['session'], 
                $response->getStatusCode()
            );
        } else {
            throw new PlivoResponseException(
                $responseContents['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()

            );
        }
        
    }


    /**
     * Get list of masking sessions
     *
     * @param array $optionalArgs
     *   + Valid arguments with their types
     *   + [string] firstParty - The phone number or SIP endpoint of the first party.
     *   + [string] secondParty - The phone number or SIP endpoint of the second party.
     *   + [string] virtual number - The virtual number associated with the masking session.
     *   + [string] status - The status of the masking session.
     *   + [string] created_time - Filter out the session based on its created time. The filter can be used in one of the following five forms:<br />
     * created_time: Input the exact value. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. 
     * created_time\__gt: gt stands for greater than. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all sessions whose created time is after 2012-03-21 11:47, use end_time\__gt=2012-03-21 11:47<br />
     * created_time\__gte: gte stands for greater than or equal. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all sessions whose created time is after or exactly at 2012-03-21 11:47[:30], use end_time\__gte=2012-03-21 11:47[:30]<br />
     * created_time\__lt: lt stands for lesser than. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all sessions whose created time is before 2012-03-21 11:47, use end_time\__lt=2012-03-21 11:47<br />
     * created_time\__lte: lte stands for lesser than or equal. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all sessions whose created time is before or exactly at 2012-03-21 11:47[:30], use end_time\__lte=2012-03-21 11:47[:30]
     *   + [string] expiry_time - Filter out the session based on its expiry time. The filter can be used in the following five forms:<br />
     * expiry_time: Input the exact value. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. 
     * expiry_time\__gt: gt stands for greater than. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all sessions whose expiry time is after 2012-03-21 11:47, use end_time\__gt=2012-03-21 11:47<br />
     * expiry_time\__gte: gte stands for greater than or equal. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all sessions whose expirty time is after or exactly at 2012-03-21 11:47[:30], use end_time\__gte=2012-03-21 11:47[:30]<br />
     * expiry_time\__lt: lt stands for lesser than. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all sessions whose expiry time is before 2012-03-21 11:47, use end_time\__lt=2012-03-21 11:47<br />
     * expiry_time\__lte: lte stands for lesser than or equal. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all sessions whose expiry time is before or exactly at 2012-03-21 11:47[:30], use end_time\__lte=2012-03-21 11:47[:30]
     *   + [string] duration - Filter the results according to duration of session. The filter can be used in one of the following five forms:<br />
     * duration: Input the exact value. E.g., to filter out sessions that were exactly three minutes long, use duration=180<br />
     * duration\__gt: gt stands for greater than. E.g., to filter out sessions that were more than two hours in duration _duration\__gt=7200<br />
     * duration\__gte: gte stands for greater than or equal to. E.g., to filter out sessions that were two hours or more in duration bill_duration\__gte=7200<br />
     * duration\__lt: lt stands for lesser than. E.g., to filter out sessions that were less than seven minutes in duration bill_duration\__lt=420<br />
     * duration\__lte: lte stands for lesser than or equal to. E.g., to filter out sessions that were two hours or less in duration bill_duration\__lte=7200

     * Note: The above filters can be combined to get sessions that ended in a particular time range. The timestamps need to be UTC timestamps.
     *   + [int] limit - Used to display the number of results per page. The maximum number of results that can be fetched is 20.
     *   + [int] offset - Denotes the number of value items by which the results should be offset. E.g., If the result contains a 1000 values and limit is set to 10 and offset is set to 705, then values 706 through 715 are displayed in the results. This parameter is also used for pagination of the results.
     * @return MaskingSessionList
     * @throws PlivoResponseException
     */
    public function listMaskingSession(array $optionalArgs = [])
    {
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );

        $responseContents = $response->getContent();
        if(!array_key_exists("error",$responseContents)){
            return new MaskingSessionListResponse(
                $responseContents['api_id'],
                $responseContents['response']['meta'],
                $responseContents['response']['objects'],
                $response->getStatusCode()
            );
        } else {
            throw new PlivoResponseException(
                $responseContents['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }
}
