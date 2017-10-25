<?php

namespace Plivo\Resources\Call;

use Plivo\Exceptions\PlivoValidationException;
use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResourceList;

use Plivo\Resources\ResponseUpdate;
use Plivo\Util\ArrayOperations;


/**
 * Class CallInterface
 * @package Plivo\Resources\Call
 * @property CallLive $live
 * @property CallList $list
 * @property ResourceList $listLive
 * @method CallList list(array $optionalArgs)
 */
class CallInterface extends ResourceInterface
{
    /**
     * CallInterface constructor.
     * @param BaseClient $plivoClient
     * @param string $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/Call/";
    }

    /**
     * Create a new call
     * @param string $from The phone number to be used as the caller id (with the country code).For e.g, a USA caller id number could be, 15677654321, with '1' for the country code.
     * @param array $to The regular number(s) or sip endpoint(s) to call. Regular number must be prefixed with country code but without the + sign). For e.g, to dial a number in the USA, the number could be, 15677654321, with '1' for the country code. Multiple numbers can be sent by using a delimiter. For e.g. 15677654321<12077657621<12047657621. Sip endpoints must be prefixed with sip: E.g., sip:john1234@phone.plivo.com. To make bulk calls, the delimiter < is used. For example, 15677654321<15673464321<sip:john1234@phone.plivo.com Yes, you can mix regular numbers and sip endpoints.
     * @param string $answerUrl The URL invoked by Plivo when the outbound call is answered.
     * @param string $answerMethod The method used to call the answer_url.
     * @param array $optionalArgs
     *   + Valid arguments with their types
     *   + [string] answer_method - The method used to call the answer_url. Defaults to POST.
     *   + [string] ring_url - The URL that is notified by Plivo when the call is ringing. Defaults not set.
     *   + [string] ring_method - The method used to call the ring_url. Defaults to POST.
     *   + [string] hangup_url - The URL that will be notified by Plivo when the call hangs up. Defaults to answer_url.
     *   + [string] hangup_method - The method used to call the hangup_url. Defaults to POST.
     *   + [string] fallback_url - Invoked by Plivo only if answer_url is unavailable or the XML response is invalid. Should contain a XML response.
     *   + [string] fallback_method - The method used to call the fallback_answer_url. Defaults to POST.
     *   + [string] caller_name - Caller name to use with the call.
     *   + [string] send_digits - Plivo plays DTMF tones when the call is answered. This is useful when dialing a phone number and an extension. Plivo will dial the number, and when the automated system picks up, sends the DTMF tones to connect to the extension. E.g. If you want to dial the 2410 extension after the call is connected, and you want to wait for a few seconds before sending the extension, add a few leading 'w' characters. Each 'w' character waits 0.5 second before sending a digit. Each 'W' character waits 1 second before sending a digit. You can also add the tone duration in ms by appending @duration after the string (default duration is 2000 ms). For example, 1w2w3@1000 See the DTMF API for additional information.
     *   + [boolean] send_on_preanswer - If set to true and send_digits is also set, digits are sent when the call is in preanswer state. Defaults to false.
     *   + [int] time_limit - Schedules the call for hangup at a specified time after the call is answered. Value should be an integer > 0(in seconds).
     *   + [int] hangup_on_ring - Schedules the call for hangup at a specified time after the call starts ringing. Value should be an integer >= 0 (in seconds).
     *   + [string] machine_detection - Used to detect if the call has been answered by a machine. The valid values are true and hangup. Default time to analyze is 5000 milliseconds (or 5 seconds). You can change it with the machine_detection_time parameter. Note that no XML is processed during the analysis phase. If a machine is detected during the call and machine_detection is set to true, the Machine parameter will be set to true and will be sent to the answer_url, hangup_url, or any other URL that is invoked by the call. If a machine is detected during the call and machine_detection is set to hangup, the call hangs up immediately and a request is made to the hangup_url with the Machine parameter set to true
     *   + [int] machine_detection_time - Time allotted to analyze if the call has been answered by a machine. It should be an integer >= 2000 and <= 10000 and the unit is ms. The default value is 5000 ms.
     *   + [string] machine_detection_url - A URL where machine detection parameters will be sent by Plivo. This parameter should be used to make machine detection asynchronous
     *   + [string] machine_detection_method - The HTTP method which will be used by Plivo to request the machine_detection_url. Defaults to POST.
     *   + [string] sip_headers- List of SIP headers in the form of 'key=value' pairs, separated by commas. E.g. head1=val1,head2=val2,head3=val3,...,headN=valN. The SIP headers are always prefixed with X-PH-. The SIP headers are present for every HTTP request made by the outbound call. Only [A-Z], [a-z] and [0-9] characters are allowed for the SIP headers key and value. Additionally, the '%' character is also allowed for the SIP headers value so that you can encode this value in the URL.
     *   + [int] ring_timeout - Determines the time in seconds the call should ring. If the call is not answered within the ring_timeout value or the default value of 120s, it is canceled.
     *   + [string] parent_call_uuid - The call_uuid of the first leg in an ongoing conference call. It is recommended to use this parameter in scenarios where a member who is already present in the conference intends to add new members by initiating outbound API calls. This minimizes the delay in adding a new memeber to the conference.
     *   + [boolean] error_parent_not_found - if set to true and the parent_call_uuid cannot be found, the API request would return an error. If set to false, the outbound call API request will be executed even if the parent_call_uuid is not found. Defaults to false.

     * @return CallCreateResponse
     * @throws PlivoValidationException
     */
    public function create($from, array $to, $answerUrl, $answerMethod,
                           array $optionalArgs = [])
    {
        $mandatoryArgs = [
            'from' => $from,
            'to' => implode('<', $to),
            'answer_url' => $answerUrl,
            'answer_method' => $answerMethod
        ];

        if (ArrayOperations::checkNull($mandatoryArgs)) {
            throw new PlivoValidationException(
                "Mandatory parameters cannot be null");
        }

        if (in_array($from, $to)) {
            throw new PlivoValidationException(
                "from and to cannot be same");
        }

        $response = $this->client->update(
            $this->uri,
            array_merge($mandatoryArgs, $optionalArgs)
        );

        $responseContents = $response->getContent();

        return new CallCreateResponse(
            $responseContents['message'],
            $responseContents['request_uuid']);
    }

    /**
     * Get details of a call
     * @param string $callUuid
     * @return Call
     * @throws PlivoValidationException
     */
    public function get($callUuid)
    {
        if (ArrayOperations::checkNull([$callUuid])) {
            throw
            new PlivoValidationException(
                'call uuid is mandatory');
        }
        $response = $this->client->fetch(
            $this->uri . $callUuid . '/',
            []
        );

        return new Call(
            $this->client,
            $response->getContent(),
            $this->pathParams['authId']);
    }

    /**
     * Get details of a live call
     *
     * @param string $liveCallUuid
     * @return CallLive
     * @throws PlivoValidationException
     */
    public function getLive($liveCallUuid)
    {
        if (ArrayOperations::checkNull([$liveCallUuid])) {
            throw
            new PlivoValidationException(
                'live call uuid is mandatory');
        }

        $params = ['status' => 'live'];

        $response = $this->client->fetch(
            $this->uri . $liveCallUuid . '/',
            $params
        );

        return new CallLive(
            $this->client,
            $response->getContent(),
            $this->pathParams['authId']);
    }

    /**
     * Get a list of calls
     *
     * @param array $optionalArgs
     *   + Valid arguments with their types
     *   + [string] subaccount - The id of the subaccount, if call details of the subaccount are needed.
     *   + [string] call_direction - Filter the results by call direction. The valid inputs are inbound and outbound.
     *   + [string] from_number - Filter the results by the number from where the call originated. For example:<br />
    To filter out those numbers that contain a particular number sequence, use from_number={sequence}<br />
    To filter out a number that matches an exact number, use from_number={exact_number}
     *   + [string] to_number - Filter the results by the number to which the call was made. Tips to use this filter are:<br />
    To filter out those numbers that contain a particular number sequence, use to_number={sequence}<br />
    To filter out a number that matches an exact number, use to_number={exact_number}
     *   + [string] bill_duration - Filter the results according to billed duration. The value of billed duration is in seconds. The filter can be used in one of the following five forms:<br />
    bill_duration: Input the exact value. E.g., to filter out calls that were exactly three minutes long, use bill_duration=180<br />
    bill_duration\__gt: gt stands for greater than. E.g., to filter out calls that were more than two hours in duration bill_duration\__gt=7200<br />
    bill_duration\__gte: gte stands for greater than or equal to. E.g., to filter out calls that were two hours or more in duration bill_duration\__gte=7200<br />
    bill_duration\__lt: lt stands for lesser than. E.g., to filter out calls that were less than seven minutes in duration bill_duration\__lt=420<br />
    bill_duration\__lte: lte stands for lesser than or equal to. E.g., to filter out calls that were two hours or less in duration bill_duration\__lte=7200
     *   + [string] end_time - Filter out calls according to the time of completion. The filter can be used in the following five forms:<br />
    end_time: The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all calls that ended at 2012-03-21 11:47[:30], use end_time=2012-03-21 11:47[:30]<br />
    end_time\__gt: gt stands for greater than. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all calls that ended after 2012-03-21 11:47, use end_time\__gt=2012-03-21 11:47<br />
    end_time\__gte: gte stands for greater than or equal. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all calls that ended after or exactly at 2012-03-21 11:47[:30], use end_time\__gte=2012-03-21 11:47[:30]<br />
    end_time\__lt: lt stands for lesser than. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all calls that ended before 2012-03-21 11:47, use end_time\__lt=2012-03-21 11:47<br />
    end_time\__lte: lte stands for lesser than or equal. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all calls that ended before or exactly at 2012-03-21 11:47[:30], use end_time\__lte=2012-03-21 11:47[:30]  
    Note: The above filters can be combined to get calls that ended in a particular time range. The timestamps need to be UTC timestamps.
     *   + [int] limit - Used to display the number of results per page. The maximum number of results that can be fetched is 20.
     *   + [int] offset - Denotes the number of value items by which the results should be offset. E.g., If the result contains a 1000 values and limit is set to 10 and offset is set to 705, then values 706 through 715 are displayed in the results. This parameter is also used for pagination of the results.
     * @return CallList
     */
    public function getList(array $optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );

        $calls = [];

        foreach ($response->getContent()['objects'] as $call) {
            $newCall = new Call($this->client, $call, $this->pathParams['authId'], $call['call_uuid']);

            array_push($calls, $newCall);
        }

        return
            new CallList(
                $this->client,
                $response->getContent()['meta'],
                $calls);
    }

    /**
     * Get a list of live calls
     *
     * @return array
     */
    public function getListLive()
    {
        $params = ['status' => 'live'];

        $response = $this->client->fetch(
            $this->uri,
            $params
        );

        $liveCallUuids = $response->getContent()['calls'];

        return $liveCallUuids;
    }

    /**
     * Hangup a call. If no arguments provided then all calls will be hung up
     *
     * @param string|null $callUuid
     */
    public function delete($callUuid = null)
    {
        $this->client->delete(
            $this->uri . $callUuid . '/',
            []
        );
    }

    /**
     * Transfer a live call
     *
     * @param string $liveCallUuid
     * @param array $optionalArgs
     *   + Valid arguments with their types
     *   + [string] legs - aleg, bleg or both Defaults to aleg. aleg will transfer call_uuid ; bleg will transfer the bridged leg (if found) of call_uuid ; both will transfer call_uuid and bridged leg of call_uuid
     *   + [string] aleg_url - URL to transfer for aleg, if legs is aleg or both, then aleg_url has to be specified.
     *   + [string] aleg_method - HTTP method to invoke aleg_url. Defaults to POST.
     *   + [string] bleg_url - URL to transfer for bridged leg, if legs is bleg or both, then bleg_url has to be specified.
     *   + [string] bleg_method - HTTP method to invoke bleg_url. Defaults to POST.
     * @return ResponseUpdate
     * @throws PlivoValidationException
     */
    public function transfer($liveCallUuid, array $optionalArgs = [])
    {

        if (empty($liveCallUuid)) {
            throw new PlivoValidationException(
                "Which call to transfer? No callUuid given");
        }

        if (isset($optionalArgs['legs'])) 
        {
            switch ($optionalArgs['legs']) {
                case 'aleg':
                    if (!isset($optionalArgs['aleg_url'])) {
                        throw new PlivoValidationException(
                            "alegUrl is mandatory"
                        );
                    }
                    break;
                case 'bleg':
                    if (!isset($optionalArgs['bleg_url'])) {
                        throw new PlivoValidationException(
                            "blegUrl is mandatory"
                        );
                    }
                    break;
                case 'both':
                    if (!(isset($optionalArgs['aleg_url']) &&
                          isset($optionalArgs['bleg_url']))) {
                        throw new PlivoValidationException(
                            "alegUrl and blegUrl are mandatory"
                        );
                    }
                    break;
                default:
                    throw new PlivoValidationException(
                        "Only aleg, bleg or both are allowed"
                    );
            }
        } else {
            throw new PlivoValidationException(
                "default is aleg, hence alegUrl is mandatory"
            );
        }

        $response = $this->client->update(
            $this->uri . $liveCallUuid . '/',
            $optionalArgs
        );

        $responseContents = $response->getContent();

        return new ResponseUpdate(
            $responseContents['message']);
    }
    
    /**
     * Start recording a live call
     *
     * @param string $liveCallUuid
     * @param array $optionalArgs
     *   + Valid arguments with their types
     *   + [int] time_limit - Max recording duration in seconds. Defaults to 60.
     *   + [string] file_format - The format of the recording. The valid formats are mp3 and wav formats. Defaults to mp3.
     *   + [string] transcription_type - The type of transcription required. The following values are allowed:
     *                                 <br /> auto - This is the default value. Transcription is completely automated; turnaround time is about 5 minutes.
     *                                 <br /> hybrid - Transcription is a combination of automated and human verification processes; turnaround time is about 10-15 minutes.
     *                                 <br /> *Our transcription service is primarily for the voicemail use case (limited to recorded files lasting for up to 2 minutes). Currently the service is available only in English and you will be charged for the usage. Please check out the price details.
     *   + [string] transcription_url - The URL where the transcription is available.
     *   + [string] transcription_method - The method used to invoke the transcription_url. Defaults to POST.
     *   + [string] callback_url - The URL invoked by the API when the recording ends. The following parameters are sent to the callback_url:
     *                           <br /> api_id - the same API ID returned by the call record API.
     *                           <br /> record_url - the URL to access the recorded file.
     *                           <br /> call_uuid - the call uuid of the recorded call.
     *                           <br /> recording_id - the recording ID of the recorded call.
     *                           <br /> recording_duration - duration in seconds of the recording.
     *                           <br /> recording_duration_ms - duration in milliseconds of the recording.
     *                           <br /> recording_start_ms - when the recording started (epoch time UTC) in milliseconds.
     *                           <br /> recording_end_ms - when the recording ended (epoch time UTC) in milliseconds.
     * @option options [String] :callback_method - The method which is used to invoke the callback_url URL. Defaults to POST.
     * @return CallRecording
     */
    public function record($liveCallUuid, array $optionalArgs = [])
    {
        return $this->startRecording($liveCallUuid, $optionalArgs);
    }

    /**
     * Start recording a live call
     *
     * @param string $liveCallUuid
     * @param array $optionalArgs
     * @param array $optionalArgs
     *   + Valid arguments with their types
     *   + [int] time_limit - Max recording duration in seconds. Defaults to 60.
     *   + [string] file_format - The format of the recording. The valid formats are mp3 and wav formats. Defaults to mp3.
     *   + [string] transcription_type - The type of transcription required. The following values are allowed:
     *                                 <br /> auto - This is the default value. Transcription is completely automated; turnaround time is about 5 minutes.
     *                                 <br /> hybrid - Transcription is a combination of automated and human verification processes; turnaround time is about 10-15 minutes.
     *                                 <br /> *Our transcription service is primarily for the voicemail use case (limited to recorded files lasting for up to 2 minutes). Currently the service is available only in English and you will be charged for the usage. Please check out the price details.
     *   + [string] transcription_url - The URL where the transcription is available.
     *   + [string] transcription_method - The method used to invoke the transcription_url. Defaults to POST.
     *   + [string] callback_url - The URL invoked by the API when the recording ends. The following parameters are sent to the callback_url:
     *                           <br /> api_id - the same API ID returned by the call record API.
     *                           <br /> record_url - the URL to access the recorded file.
     *                           <br /> call_uuid - the call uuid of the recorded call.
     *                           <br /> recording_id - the recording ID of the recorded call.
     *                           <br /> recording_duration - duration in seconds of the recording.
     *                           <br /> recording_duration_ms - duration in milliseconds of the recording.
     *                           <br /> recording_start_ms - when the recording started (epoch time UTC) in milliseconds.
     *                           <br /> recording_end_ms - when the recording ended (epoch time UTC) in milliseconds.
     * @option options [String] :callback_method - The method which is used to invoke the callback_url URL. Defaults to POST.
     * @return CallRecording
     * @throws PlivoValidationException
     */
    public function startRecording($liveCallUuid, array $optionalArgs = [])
    {
        if (empty($liveCallUuid)) {
            throw new PlivoValidationException(
                "Which call to record? No callUuid given");
        }

        $response = $this->client->update(
            $this->uri . $liveCallUuid . '/Record/',
            $optionalArgs
        );

        $responseContents = $response->getContent();

        return new CallRecording(
            $responseContents['message'],
            $responseContents['url'],
            $responseContents['recording_id']);
    }
    
    /**
     * Stop recording a live call
     *
     * @param string $liveCallUuid
     * @param string|null $url - You can specify a record URL to stop only one record. By default all recordings are stopped.
     * @throws PlivoValidationException
     */
    public function stopRecording($liveCallUuid, $url = null)
    {
        if (empty($liveCallUuid)) {
            throw new PlivoValidationException(
                "Which call to stop recording? No callUuid given");
        }

        $params = [];
        
        if (!empty($url)) {
            $params = ['URL' => $url];
        }
        
        
        $this->client->delete(
            $this->uri . $liveCallUuid . '/Record/',
            $params
        );
    }
    
    /**
     * Start playing audio in a live call
     *
     * @param string $liveCallUuid The UUID of live call
     * @param array $urls URLs of audio files
     * @param array $optionalArgs
     * @return ResponseUpdate
     */
    public function play($liveCallUuid, $urls, array $optionalArgs = [])
    {
        return $this->startPlaying($liveCallUuid, $urls, $optionalArgs);
    }

    /**
     * Start playing audio in a live call
     *
     * @param string $liveCallUuid
     * @param array $urls
     * @param array $optionalArgs
     *   + Valid arguments with their types
     *   + [array of strings] urls - A single URL or a list of comma separated URLs linking to an mp3 or wav file.
     *   + [int] length - Maximum length in seconds that the audio should be played.
     *   + [string] legs - The leg on which the music will be played, can be aleg (i.e., A-leg is the first leg of the call or current call), bleg (i.e., B-leg is the second leg of the call),or both (i.e., both legs of the call).
     *   + [boolean] loop - If set to true, the audio file will play indefinitely.
     *   + [boolean] mix - If set to true, sounds are mixed with current audio flow.
     * @return ResponseUpdate
     * @throws PlivoValidationException
     */
    public function startPlaying($liveCallUuid, array $urls, array $optionalArgs = [])
    {
        if (empty($liveCallUuid)) {
            throw new PlivoValidationException(
                "Which call to play in? No callUuid given");
        }

        if (empty($urls)) {
            throw new PlivoValidationException(
                "urls cannot be null");
        }

        $response = $this->client->update(
            $this->uri . $liveCallUuid . '/Play/',
            array_merge(
                ['urls' => join(',', $urls)],
                $optionalArgs)
        );

        $responseContents = $response->getContent();

        return new ResponseUpdate(
            $responseContents['message']);
    }

    /**
     * Stop playing audio in a live call
     *
     * @param string $liveCallUuid
     * @throws PlivoValidationException
     */
    public function stopPlaying($liveCallUuid)
    {
        if (empty($liveCallUuid)) {
            throw new PlivoValidationException(
                "Which call to stop playing in? No callUuid given");
        }

        $this->client->delete(
            $this->uri . $liveCallUuid . '/Play/',
            []
        );
    }
    
    /**
     * Start speaking in a live call
     *
     * @param string $liveCallUuid
     * @param string $text
     * @param array $optionalArgs
     *   + Valid arguments with their types
     *   + [string] voice - The voice to be used, can be MAN, WOMAN.
     *   + [int] language - The language to be used, see Supported voices and languages {https://www.plivo.com/docs/api/call/speak/#supported-voices-and-languages}
     *   + [string] legs - The leg on which the music will be played, can be aleg (i.e., A-leg is the first leg of the call or current call), bleg (i.e., B-leg is the second leg of the call),or both (i.e., both legs of the call).
     *   + [boolean] loop - If set to true, the audio file will play indefinitely.
     *   + [boolean] mix - If set to true, sounds are mixed with current audio flow.
     * @return ResponseUpdate
     */
    public function speak($liveCallUuid, $text, array $optionalArgs = [])
    {
        return $this->startSpeaking($liveCallUuid, $text, $optionalArgs);
    }

    /**
     * Start speaking in a live call
     *
     * @param string $liveCallUuid
     * @param string $text The text to speak
     * @param array $optionalArgs
     *   + Valid arguments with their types
     *   + [string] voice - The voice to be used, can be MAN, WOMAN.
     *   + [int] language - The language to be used, see Supported voices and languages {https://www.plivo.com/docs/api/call/speak/#supported-voices-and-languages}
     *   + [string] legs - The leg on which the music will be played, can be aleg (i.e., A-leg is the first leg of the call or current call), bleg (i.e., B-leg is the second leg of the call),or both (i.e., both legs of the call).
     *   + [boolean] loop - If set to true, the audio file will play indefinitely.
     *   + [boolean] mix - If set to true, sounds are mixed with current audio flow.
     * @return ResponseUpdate
     * @throws PlivoValidationException
     */
    public function startSpeaking($liveCallUuid, $text, array $optionalArgs = [])
    {
        if (empty($liveCallUuid)) {
            throw new PlivoValidationException(
                "Which call to speak in? No callUuid given");
        }

        if (empty($text)) {
            throw new PlivoValidationException(
                "text cannot be null");
        }

        $response = $this->client->update(
            $this->uri . $liveCallUuid . '/Speak/',
            array_merge(['text'=>$text], $optionalArgs)
        );

        $responseContents = $response->getContent();

        return new ResponseUpdate(
            $responseContents['message']);
    }

    /**
     * Stop speaking in a live call
     *
     * @param string $liveCallUuid
     * @throws PlivoValidationException
     */
    public function stopSpeaking($liveCallUuid)
    {
        if (empty($liveCallUuid)) {
            throw new PlivoValidationException(
                "Which call to stop speaking in? No callUuid given");
        }

        $this->client->delete(
            $this->uri . $liveCallUuid . '/Speak/',
            []
        );
    }

    /**
     * Send digits in a live call
     *
     * @param string $liveCallUuid
     * @param $digits
     * @param null $leg
     * @return ResponseUpdate
     * @throws PlivoValidationException
     */
    public function dtmf($liveCallUuid, $digits, $leg = null)
    {
        if (empty($liveCallUuid)) {
            throw new PlivoValidationException(
                "Which call to send digits in? No callUuid given");
        }

        if (empty($digits)) {
            throw new PlivoValidationException(
                "digits cannot be null");
        }

        $response = $this->client->update(
            $this->uri . $liveCallUuid . '/DTMF/',
            [
                'digits' => $digits,
                'leg' => $leg
            ]
        );

        $responseContents = $response->getContent();

        return new ResponseUpdate(
            $responseContents['message']);
    }
    
    /**
     * Cancel the request
     *
     * @param string $requestUuid
     * @throws PlivoValidationException
     */
    public function cancel($requestUuid)
    {
        if (empty($requestUuid)) {
            throw new PlivoValidationException(
                "Which call request to cancel? No requestUuid given");
        }
        $this->client->delete(
            "Account/".
            $this->pathParams['authId'].
            "/Request/".
            $requestUuid.
            '/',
            []
        );
    }
}