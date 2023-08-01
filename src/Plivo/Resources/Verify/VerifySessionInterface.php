<?php

namespace Plivo\Resources\Verify;



use Plivo\Exceptions\PlivoValidationException;
use Plivo\Exceptions\PlivoRestException;
use Plivo\Exceptions\PlivoResponseException;
use Plivo\Util\ArrayOperations;
use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;
use Plivo\Exceptions\PlivoNotFoundException;
use Plivo\Resources\ResourceList;

/**
 * Class VerifySessionInterface
 * @package Plivo\Resources\Verify
 */
class VerifySessionInterface extends ResourceInterface
{
    /**
     * VerifySessionInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    /**
     * @var null
     */
    public function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/";
    }

    /**
     * @param string $sessionUuid
     * @return VerifySession
     * @throws PlivoValidationException
     */
    public function get($sessionUuid)
    {
        if (ArrayOperations::checkNull([$sessionUuid])) {
            throw
            new PlivoValidationException(
                'session uuid is mandatory');
        }

        $response = $this->client->fetch(
            $this->uri . 'Verify/Session/'. $sessionUuid .'/',
            []
        );

        // return the object for chain method 
        if ($response->getStatusCode() == 200){
            return new VerifySession(
            $this->client, $response->getContent(),
            $this->pathParams['authId'], $this->uri);
        }
        return json_encode($response->getContent(), JSON_FORCE_OBJECT);
    }

  

     /**
     * Return a list of sessions
     * @param array $optionalArgs
     *   + Valid arguments
     *   + [string] :session_time  - Filter out sessions according to the time of completion. The filter can be used in the following five forms:
     *                     <br /> session_time: The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. Eg:- To get all sessions that were sent/received at 2012-03-21 11:47[:30], use session_time=2012-03-21 11:47[:30]
     *                     <br /> session_time\__gt: gt stands for greater than. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. Eg:- To get all sessions that were sent/received after 2012-03-21 11:47, use session_time\__gt=2012-03-21 11:47
     *                     <br /> session_time\__gte: gte stands for greater than or equal. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. Eg:- To get all sessions that were sent/received after or exactly at 2012-03-21 11:47[:30], use session_time\__gte=2012-03-21 11:47[:30]
     *                     <br /> session_time\__lt: lt stands for lesser than. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. Eg:- To get all sessions that were sent/received before 2012-03-21 11:47, use session_time\__lt=2012-03-21 11:47
     *                     <br /> session_time\__lte: lte stands for lesser than or equal. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. Eg:- To get all sessions that were sent/received before or exactly at 2012-03-21 11:47[:30], use session_time\__lte=2012-03-21 11:47[:30]
     *                     <br /> Note: The above filters can be combined to get sessions that were sent/received in a particular time range. The timestamps need to be UTC timestamps.
     *   + [string] :status - Status value of the session, is one of "in-progress", "validated" or "expired".
     *   + [int] :limit - Used to display the number of results per page. The maximum number of results that can be fetched is 20.
     *   + [int] :offset - Denotes the number of value items by which the results should be offset. Eg:- If the result contains a 1000 values and limit is set to 10 and offset is set to 705, then values 706 through 715 are displayed in the results. This parameter is also used for pagination of the results.
     *   + [string] : recipient - Filters the results by recipient number.
     *   + [string] : app_uuid - Filter the results by App UUID.
     *   + [string]: country -  Filter the results by country. For e.g. Filter results for India using 'IN' as the value.
     *   + [string]: alias - Filter the results using alias of verify application.
     * @return VerifySessionList output
     */
    public function list( $optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri . 'Verify/Session/',
            $optionalArgs
        );

        if(!array_key_exists("error", $response->getContent())) {
            $sessions = [];
            foreach ($response->getContent()['sessions'] as $session) {
                $newSession = new VerifySession($this->client, $session, $this->pathParams['authId'], $this->uri);
                array_push($sessions, $newSession);
            }
            return new VerifySessionList($this->client, $response->getContent()['meta'], $sessions, $response->getContent()["api_id"]);
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
     * Create a new Session
     *
     * @param string $recipient
     * @param array $optionalArgs
     *   + Valid arguments
     *   + [string] :app_uuid - The application that needs to be used for sending the verification code.
     *   + [string] :channel - The channel to be used for sending the verification code. NOTE: Application should support the channel mentioned.
     *   + [string] :url - The URL to which with the status of the session is sent. The following parameters are sent to the URL:
     *                   <br /> SessionUUID - The unique ID for the session
     *                   <br /> ChannelStatus - The status received from the channel(sms/voice).
     *                   <br /> Recipient - The number to which verification code is sent.
     *                   <br /> RequestTime - The time at which the session request was made.
     *                   <br /> AttemptUUID - The unique ID for the channel(sms/voice) through which verification code is sent.
     *                   <br /> Channel - The channel(sms/voice) through which verification code is sent.
     *                   <br /> ChannelErrorCode - Error code received from the channel if any error occurred.
     *                   <br /> AttemptSequence - The attempt number for which the session status is received. For e.g. is two attempted are made within a session, 1st via SMS and 2nd via Voice, then callbacks received for SMS would have AttemptSequence value as 1 and for Voice it would be 2.
     *                   <br /> SessionStatus - The status of the session(in-progress/validated/expired).
     *   + [string] :method - The method used to call the url. Defaults to POST.
     * @return VerifySessionCreateResponse output
     * @throws PlivoValidationException,PlivoResponseException
     */
    public function create($recipient, array $optionalArgs = [])
    {
        $mandatoryArgs = [
            'recipient' => $recipient,
        ];

        if (ArrayOperations::checkNull($mandatoryArgs)) {
            throw new PlivoValidationException(
                "Mandatory parameters cannot be null");
        }

        $response = $this->client->update(
            $this->uri .'Verify/Session/',
            array_merge($mandatoryArgs, $optionalArgs)
        );

        $responseContents = $response->getContent();
        
        if(array_key_exists("error",$responseContents)){
            throw new PlivoResponseException(
                $responseContents['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()

            );
        } else {
            return new VerifySessionCreateResponse(
                $responseContents['message'],
                $responseContents['session_uuid'],
                $responseContents['api_id'],
                $response->getStatusCode()
            );
        }
    }


    /**
     * Validate Session
     *
     * @param string $sessionUuid
     * @param string $otp
     * @return VerifySessionCreateResponse
     */
    public function validate($sessionUuid, $otp)
    {

        $mandatoryArgs = [
            'otp' => $otp,
        ];

        if (ArrayOperations::checkNull([$sessionUuid])) {
            throw
            new PlivoValidationException(
                'session uuid is mandatory');
        }
       
        if (ArrayOperations::checkNull($mandatoryArgs)) {
            throw new PlivoValidationException(
                "Mandatory parameters cannot be null");
        }

        $response = $this->client->update(
            $this->uri . 'Verify/Session/'. $sessionUuid .'/',
            $mandatoryArgs
        );

        $responseContents = $response->getContent();
        
        if(array_key_exists("error",$responseContents)){
            throw new PlivoResponseException(
                $responseContents['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()

            );
        } else {
            return new VerifySessionCreateResponse(
                $responseContents['message'],
                "",
                $responseContents['api_id'],
                $response->getStatusCode()
            );
        }
    }


}