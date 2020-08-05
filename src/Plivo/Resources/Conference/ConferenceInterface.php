<?php
/**
 * Created by PhpStorm.
 * User: kritarth
 * Date: 25/05/17
 * Time: 4:02 PM
 */

namespace Plivo\Resources\Conference;


use Plivo\Exceptions\PlivoValidationException;
use Plivo\Exceptions\PlivoResponseException;
use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResponseDelete;
use Plivo\Resources\ResponseUpdate;
use Plivo\Util\ArrayOperations;

/**
 * Class ConferenceInterface
 * @package Plivo\Resources\Conference
 * @property array list Lists the conferences going on
 */
class ConferenceInterface extends ResourceInterface
{
    /**
     * @var
     */
    protected $memberUri;

    /**
     * ConferenceInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    function __construct(BaseClient $plivoClient , $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/" . $authId . "/Conference/";
    }

    /**
     * @param string $conferenceName
     * @return Conference
     * @throws PlivoValidationException
     */
    public function get($conferenceName)
    {
        if (ArrayOperations::checkNull([$conferenceName])) {
            throw
            new PlivoValidationException(
                'conference name is mandatory');
        }
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->fetch(
            $this->uri . $conferenceName . '/',
            $optionalArgs
        );



        return new Conference(
            $this->client,
            $response->getContent(),
            $this->pathParams['authId'],
            $conferenceName);
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );

        $conferenceNames = $response->getContent()['conferences'];

        return $conferenceNames;
    }

    /**
     * @param null $conferenceName
     * @return ResponseDelete
     */
    public function delete($conferenceName)
    {
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->delete(
            $this->uri . $conferenceName . '/',
            $optionalArgs
        );

        return new ResponseDelete();
    }

    /**
     * @return ResponseDelete
     */
    public function deleteAll()
    {
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->delete(
            $this->uri,
            $optionalArgs
        );

        return new ResponseDelete();
    }

    /**
     * @param $conferenceName
     * @param $memberId
     * @return ResponseDelete
     */
    public function hangUpMember($conferenceName, $memberId)
    {
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->delete(
            $this->uri . $conferenceName . '/Member/' . $memberId . '/',
            $optionalArgs
        );

        return new ResponseDelete();
    }

    /**
     * @param $conferenceName
     * @param $memberId
     * @return ResponseUpdate
     */
    public function kickMember($conferenceName, $memberId)
    {
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->update(
            $this->uri .
            $conferenceName .
            '/Member/' .
            $memberId .
            '/Kick/',
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
                $responseContents['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()

            );
        }

        
    }

    /**
     * @param $conferenceName
     * @param array $memberId
     * @return ResponseUpdate
     */
    public function muteMember($conferenceName, array $memberId)
    {
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->update(
            $this->uri .
            $conferenceName .
            '/Member/' .
            join(',', $memberId) .
            '/Mute/',
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
                $responseContents['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()

            );
        }
    }

    /**
     * @param $conferenceName
     * @param array $memberId
     * @return ResponseDelete
     */
    public function unMuteMember($conferenceName, array $memberId)
    {
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->delete(
            $this->uri .
            $conferenceName .
            '/Member/' .
            join(',', $memberId) .
            '/Mute/',
            $optionalArgs
        );

        return new ResponseDelete();
    }

    /**
     * @param $conferenceName
     * @param array $memberId
     * @param $url
     * @return ResponseUpdate
     */
    public function startPlaying($conferenceName, array $memberId, $url)
    {
        $response = $this->client->update(
            $this->uri .
            $conferenceName .
            '/Member/' .
            join(',', $memberId) .
            '/Play/',
            ['url' => $url,
             'isVoiceRequest' => true]
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
                $responseContents['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()

            );
        }
    }

    /**
     * @param $conferenceName
     * @param array $memberId
     * @return ResponseDelete
     */
    public function stopPlaying($conferenceName, array $memberId)
    {
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->delete(
            $this->uri .
            $conferenceName .
            '/Member/' .
            join(',', $memberId) .
            '/Play/',
            $optionalArgs
        );

        return new ResponseDelete();
    }

    /**
     * @param $conferenceName
     * @param array $memberId
     * @param $text
     * @param array $optionalArgs
     *   + Valid arguments
     *   + [string] voice - The voice to be used. Can be MAN or WOMAN. Defaults to WOMAN.
     *   + [string] language - The language to be used, see Supported voices and languages {https://www.plivo.com/docs/api/conference/member/#supported-voice-and-languages}. Defaults to en-US .
     * @return ResponseUpdate
     */
    public function startSpeaking($conferenceName, array $memberId, $text, array $optionalArgs = [])
    {
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->update(
            $this->uri .
            $conferenceName .
            '/Member/' .
            join(',', $memberId) .
            '/Speak/',
            array_merge(['text'=>$text], $optionalArgs)
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
                $responseContents['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()

            );
        }
    }

    /**
     * @param $conferenceName
     * @param array $memberId
     * @return ResponseDelete
     */
    public function stopSpeaking($conferenceName, array $memberId)
    {
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->delete(
            $this->uri .
            $conferenceName .
            '/Member/' .
            join(',', $memberId) .
            '/Speak/',
            $optionalArgs
        );

        return new ResponseDelete();
    }

    /**
     * @param $conferenceName
     * @param array $memberId
     * @return ResponseUpdate
     */
    public function makeDeaf($conferenceName, array $memberId)
    {
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->update(
            $this->uri .
            $conferenceName .
            '/Member/' .
            join(',', $memberId) .
            '/Deaf/',
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
                $responseContents['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()

            );
        }
    }

    /**
     * @param $conferenceName
     * @param array $memberId
     * @return ResponseDelete
     */
    public function enableHearing($conferenceName, array $memberId)
    {
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->delete(
            $this->uri .
            $conferenceName .
            '/Member/' .
            join(',', $memberId) .
            '/Deaf/',
            $optionalArgs
        );

        return new ResponseDelete();
    }

    /**
     * @param $conferenceName
     * @param $optionalArgs
     *   + Valid arguments
     *   + [string] file_format - The file format of the record can be of mp3 or wav format. Defaults to mp3 format.
     *   + [string] transcription_type - The type of transcription required. The following values are allowed:
     *                          <br /> auto - This is the default value. Transcription is completely automated; turnaround time is about 5 minutes.
     *                          <br /> hybrid - Transcription is a combination of automated and human verification processes; turnaround time is about 10-15 minutes.
     *   + [string] transcription_url - The URL where the transcription is available.
     *   + [string] transcription_method - The method used to invoke the transcription_url. Defaults to POST.
     *   + [string] callback_url - The URL invoked by the API when the recording ends. The following parameters are sent to the callback_url:
     *                    <br /> api_id - the same API ID returned by the conference record API.
     *                    <br /> record_url - the URL to access the recorded file.
     *                    <br /> recording_id - recording ID of the recorded file.
     *                    <br /> conference_name - the conference name recorded.
     *                    <br /> recording_duration - duration in seconds of the recording.
     *                    <br /> recording_duration_ms - duration in milliseconds of the recording.
     *                    <br /> recording_start_ms - when the recording started (epoch time UTC) in milliseconds.
     *                    <br /> recording_end_ms - when the recording ended (epoch time UTC) in milliseconds.
     *   + [string] callback_method - The method which is used to invoke the callback_url URL. Defaults to POST.
 
     * @return ConferenceRecording
     */
    public function startRecording($conferenceName, $optionalArgs = [])
    {
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->update(
            $this->uri .
            $conferenceName .
            '/Record/',
            $optionalArgs
        );

        $responseContents = $response->getContent();

        if(!array_key_exists("error",$responseContents)){
            return new ConferenceRecording(
                $responseContents['api_id'],
                $responseContents['message'],
                $responseContents['recording_id'],
                $responseContents['url'],
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
     * @param $conferenceName
     * @return ResponseDelete
     */
    public function stopRecording($conferenceName)
    {
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->delete(
            $this->uri .
            $conferenceName .
            '/Record/',
            $optionalArgs
        );

        return new ResponseDelete();
    }

}