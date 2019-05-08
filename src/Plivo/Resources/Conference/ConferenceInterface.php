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
    public function get($conferenceName=null)
    {
        if (ArrayOperations::checkNull([$conferenceName])) {
            throw
            new PlivoValidationException(
                'conference name is mandatory');
        }

        $response = $this->client->fetch(
            $this->uri . $conferenceName . '/',
            []
        );
        $responseContents= $response->getContent();
        return new Conference(
            $this->client,
            $responseContents['api_id'],
            $responseContents,
            $this->pathParams['authId'],
            $conferenceName);
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        $response = $this->client->fetch(
            $this->uri,
            []
        );

        $conferenceNames = $response->getContent()['conferences'];

        return $conferenceNames;
    }

    /**
     * @param null $conferenceName
     * @return ResponseDelete
     */
    public function delete($conferenceName=null)
    {
        if (empty($conferenceName)) {
            throw
            new PlivoValidationException(
                'conference_name is mandatory');
        }
        $response = $this->client->delete(
            $this->uri . $conferenceName . '/',
            []
        );

        return new ResponseDelete();
    }

    /**
     * @return ResponseDelete
     */
    public function deleteAll()
    {
        $response = $this->client->delete(
            $this->uri,
            []
        );

        return new ResponseDelete();
    }

    /**
     * @param $conferenceName
     * @param $memberId
     * @return ResponseDelete
     */
    public function hangUpMember($conferenceName=null,$memberId=null)

    {

      if (empty($conferenceName)) {
          throw
          new PlivoValidationException(
              'conference_name is mandatory');
        }

      if (empty($memberId)){
          throw
          new PlivoValidationException(
              'member_id is mandatory');
        }

        if (!is_numeric($memberId)){
          throw
          new PlivoValidationException(
              'member_id should be numeric');
        }

        $response = $this->client->delete(
            $this->uri . $conferenceName . '/Member/' . $memberId . '/',
            []
        );

        return new ResponseDelete();
    }

    /*
    Additional validation to check if the member ID is numeric values
    Response:
    (
        [message:protected] => member_id should be numeric
        [string:Exception:private] =>
        [code:protected] => 0
        [file:protected] => /Users/kiran/Desktop/plivotest/plivo-php/src/Plivo/Resources/Conference/ConferenceInterface.php
        [line:protected] => 146
        [trace:Exception:private] => Array
            (
                [0] => Array
                    (
                        [file] => /Users/kiran/Desktop/plivotest/plivo-php/programs/conference.php
                        [line] => 12
                        [function] => hangUpMember
                        [class] => Plivo\Resources\Conference\ConferenceInterface
                        [type] => ->
                        [args] => Array
                            (
                                [0] => My conference
                                [1] => abd
                            )

                    )

            )

        [previous:Exception:private] =>
    )


    Also, the  $conferenceName and $memberId is set to null.
    Since the Attributecount error was overriding PlivoValidationException
*/

    /**
     * @param $conferenceName
     * @param $memberId
     * @return ResponseUpdate
     */
    public function kickMember($conferenceName=null, $memberId=null)
    {
        if (empty($conferenceName)) {
            throw
            new PlivoValidationException(
                'conference_name is mandatory');
        }

        if (empty($memberId)) {
            throw
            new PlivoValidationException(
                'member_id is mandatory');
        }

        if (!is_numeric($memberId)){
          throw
          new PlivoValidationException(
              'member_id should be numeric');
        }

    /* Addional validation as been added.
    Now we also check if the member_id is numeric */

        $response = $this->client->update(
            $this->uri .
            $conferenceName .
            '/Member/' .
            $memberId .
            '/Kick/',
            []
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
    public function muteMember($conferenceName=null, array $memberId=null)
    {
        if (empty($conferenceName)) {
            throw
            new PlivoValidationException(
                'conference_name is mandatory');
        }

        if (empty($memberId)) {
            throw
            new PlivoValidationException(
                'member_id is mandatory');
        }

        if (!is_numeric($memberId)){
          throw
          new PlivoValidationException(
              'member_id should be numeric');
        }

        /* Addional validation as been added.
        Now we also check if the member_id is numeric */

        $response = $this->client->update(
            $this->uri .
            $conferenceName .
            '/Member/' .
            join(',', $memberId) .
            '/Mute/',
            []
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
    public function unMuteMember($conferenceName=null, array $memberId=null)
    {
        if (empty($conferenceName)) {
            throw
            new PlivoValidationException(
                'conference_name is mandatory');
        }

        if (empty($memberId)) {
            throw
            new PlivoValidationException(
                'member_id is mandatory');
        }

        if (!is_numeric($memberId)){
          throw
          new PlivoValidationException(
              'member_id should be numeric');
        }

        /* Addional validation as been added.
        Now we also check if the member_id is numeric */

        $response = $this->client->delete(
            $this->uri .
            $conferenceName .
            '/Member/' .
            join(',', $memberId) .
            '/Mute/',
            []
        );

        return new ResponseDelete();
    }

    /**
     * @param $conferenceName
     * @param array $memberId
     * @param $url
     * @return ResponseUpdate
     */
    public function startPlaying($conferenceName=null, array $memberId=null, $url=null)
    {
        if (empty($conferenceName)) {
            throw
            new PlivoValidationException(
                'conference_name is mandatory');
        }

        if (empty($memberId)) {
            throw
            new PlivoValidationException(
                'member_id is mandatory');
        }

        if (empty($url)) {
            throw new PlivoValidationException(
                "url parameter is mandatory");
        }

        foreach($memberId as $ar){
          if(!is_numeric($ar)){
              throw
              new PlivoValidationException(
                  'member_id should be numeric');
            }
        }

        if(filter_var($url, FILTER_VALIDATE_URL) === FALSE){
          throw new PlivoValidationException(
              "url is incorrect");
        }

        /* Addional validation as been added.
        Now we also check if the member_id is numeric and if the URL is valid

      --------------------------
      When member ID is not numeric:
    [message:protected] => member_id should be numeric
    [string:Exception:private] =>
    [code:protected] => 0
    [file:protected] => /Users/kiran/Desktop/plivotest/plivo-php/src/Plivo/Resources/Conference/ConferenceInterface.php
    [line:protected] => 375
    [trace:Exception:private] => Array
        (
            [0] => Array
                (
                    [file] => /Users/kiran/Desktop/plivotest/plivo-php/programs/conference.php
                    [line] => 13
                    [function] => startPlaying
                    [class] => Plivo\Resources\Conference\ConferenceInterface
                    [type] => ->
                    [args] => Array
                        (
                            [0] => My Conf Room
                            [1] => Array
                                (
                                    [0] => 10
                                    [1] => we
                                )

                            [2] => s3.amazonaws.com/plivocloud/Trumpet.mp3
                        )

                )

        )

    When URL is incorrect:

        Plivo\Exceptions\PlivoValidationException Object
       (
           [message:protected] => url is incorrect
           [string:Exception:private] =>
           [code:protected] => 0
           [file:protected] => /Users/kiran/Desktop/plivotest/plivo-php/src/Plivo/Resources/Conference/ConferenceInterface.php
           [line:protected] => 381
           [trace:Exception:private] => Array
               (
                   [0] => Array
                       (
                           [file] => /Users/kiran/Desktop/plivotest/plivo-php/programs/conference.php
                           [line] => 13
                           [function] => startPlaying
                           [class] => Plivo\Resources\Conference\ConferenceInterface
                           [type] => ->
                           [args] => Array
                               (
                                   [0] => My Conf Room
                                   [1] => Array
                                       (
                                           [0] => 10
                                           [1] => 11
                                       )

                                   [2] => s3.amazonaws.com/plivocloud/Trumpet.mp3
                               )

                       )

               )

           [previous:Exception:private] =>
       )


        */

        $response = $this->client->update(
            $this->uri .
            $conferenceName .
            '/Member/' .
            join(',', $memberId) .
            '/Play/',
            ['url' => $url]
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
    public function stopPlaying($conferenceName=null, array $memberId=null)
    {
        if (empty($conferenceName)) {
            throw
            new PlivoValidationException(
                'conference_name is mandatory');
        }

        if (empty($memberId)) {
            throw
            new PlivoValidationException(
                'member_id is mandatory');
        }

        foreach($memberId as $ar){
          if(!is_numeric($ar)){
              throw
              new PlivoValidationException(
                  'member_id should be numeric');
            }
        }

        /* Addional validation as been added.
        Now we also check if the member_id is numeric */

        $response = $this->client->delete(
            $this->uri .
            $conferenceName .
            '/Member/' .
            join(',', $memberId) .
            '/Play/',
            []
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
    public function startSpeaking($conferenceName=null, array $memberId=null, $text=null, array $optionalArgs = [])
    {
        if (empty($conferenceName)) {
            throw
            new PlivoValidationException(
                'conference_name is mandatory');
        }

        if (empty($memberId)) {
            throw
            new PlivoValidationException(
                'member_id is mandatory');
        }

        if (empty($text)) {
            throw
            new PlivoValidationException(
                'text is mandatory');
        }

        foreach($memberId as $ar){
          if(!is_numeric($ar)){
              throw
              new PlivoValidationException(
                  'member_id should be numeric');
            }
        }

        /* Addional validation as been added.
        Now we also check if the member_id is numeric */

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
    public function stopSpeaking($conferenceName=null, array $memberId=null)
    {
        if (empty($conferenceName)) {
            throw
            new PlivoValidationException(
                'conference_name is mandatory');
        }

        if (empty($memberId)) {
            throw
            new PlivoValidationException(
                'member_id is mandatory');
        }

        foreach($memberId as $ar){
          if(!is_numeric($ar)){
              throw
              new PlivoValidationException(
                  'member_id should be numeric');
            }
        }

        /* Addional validation as been added.
        Now we also check if the member_id is numeric */

        $response = $this->client->delete(
            $this->uri .
            $conferenceName .
            '/Member/' .
            join(',', $memberId) .
            '/Speak/',
            []
        );

        return new ResponseDelete();
    }

    /**
     * @param $conferenceName
     * @param array $memberId
     * @return ResponseUpdate
     */
    public function makeDeaf($conferenceName=null, array $memberId=null)
    {
        if (empty($conferenceName)) {
            throw
            new PlivoValidationException(
                'conference_name is mandatory');
        }

        if (empty($memberId)) {
            throw
            new PlivoValidationException(
                'member_id is mandatory');
        }

        foreach($memberId as $ar){
          if(!is_numeric($ar)){
              throw
              new PlivoValidationException(
                  'member_id should be numeric');
            }
        }

        /* Addional validation as been added.
        Now we also check if the member_id is numeric */

        $response = $this->client->update(
            $this->uri .
            $conferenceName .
            '/Member/' .
            join(',', $memberId) .
            '/Deaf/',
            []
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
    public function enableHearing($conferenceName=null, array $memberId=null)
    {
        if (empty($conferenceName)) {
            throw
            new PlivoValidationException(
                'conference_name is mandatory');
        }

        if (empty($memberId)) {
            throw
            new PlivoValidationException(
                'member_id is mandatory');
        }

        foreach($memberId as $ar){
          if(!is_numeric($ar)){
              throw
              new PlivoValidationException(
                  'member_id should be numeric');
            }
        }

        /* Addional validation as been added.
        Now we also check if the member_id is numeric */

        $response = $this->client->delete(
            $this->uri .
            $conferenceName .
            '/Member/' .
            join(',', $memberId) .
            '/Deaf/',
            []
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
    public function startRecording($conferenceName=null, $optionalArgs = [])
    {
        if (empty($conferenceName)) {
            throw
            new PlivoValidationException(
                'conference_name is mandatory');
        }

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
    public function stopRecording($conferenceName=null)
    {
        if (empty($conferenceName)) {
            throw
            new PlivoValidationException(
                'conference_name is mandatory');
        }

        $response = $this->client->delete(
            $this->uri .
            $conferenceName .
            '/Record/',
            []
        );

        return new ResponseDelete();
    }

}
