<?php

namespace Plivo\Resources\Recording;


use Plivo\Exceptions\PlivoValidationException;
use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResourceList;
use Plivo\Util\ArrayOperations;

/**
 * Class RecordingInterface
 * @package Plivo\Resources\Recording
 */
class RecordingInterface extends ResourceInterface
{
    /**
     * RecordingInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);

        $this->pathParams = [
            'authId' => $authId
        ];

        $this->uri = "Account/".$authId."/Recording/";
    }

    /**
     * @param array $optionalArgs
     *   + Valid arguments
     *   + [string] subaccount  - auth_id of the subaccount. Lists only those recordings of the main accounts which are tied to the specified subaccount.
     *   + [string] call_uuid   - Used to filter recordings for a specific call.
     *   + [string] to_number   - Used to filter recordings for a specific to_number.
     *   + [string] from_number - Used to filter recordings for a specific from_number.
     *   + [string] conference_name - Used to filter recordings for a specific conference_name.
     *   + [string] mpc_name - Used to filter recordings for a specific mpc_name.
     *   + [string] conference_uuid - Used to filter recordings for a specific conference_uuid.
     *   + [string] mpc_uuid - Used to filter recordings for a specific mpc_uuid.
     *   + [string] add_time - Used to filter out recordings according to the time they were added.The add_time filter is a comparative filter that can be used in the following four forms:
     *                         <br /> add_time\__gt: gt stands for greater than. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. Eg:- To get all recordings that started after 2012-03-21 11:47, use add_time\__gt=2012-03-21 11:47
     *                         <br /> add_time\__gte: gte stands for greater than or equal. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. Eg:- To get all recordings that started after or exactly at 2012-03-21 11:47[:30], use add_time\__gte=2012-03-21 11:47[:30]
     *                         <br /> add_time\__lt: lt stands for lesser than. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. Eg:- To get all recordings that started before 2012-03-21 11:47, use add_time\__lt=2012-03-21 11:47
     *                         <br /> add_time\__gte: lte stands for lesser than or equal. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. Eg:- To get all recordings that started before or exactly at 2012-03-21 11:47[:30], use add_time\__lte=2012-03-21 11:47[:30]
     *                         <br /> Note: The above filters can be combined to get recordings that started in a particular time range.
     *   + [int] recording_storage_duration - Used to filter out recordings according to the number of days they have been stored in the DB.The recording_storage_duration filter can be used in the following five forms:
     *                         <br /> recording_storage_duration: Takes an integer input and returns the recordings which are as old as that value.
     *                         <br /> recording_storage_duration\__gt: gt stands for greater than. The format expected is an integer value. Eg:- To get all recordings that are older than 100 days, use recording_storage_duration\__gt=100
     *                         <br /> recording_storage_duration\__gte: gte stands for greater than or equal. The format expected is an integer value. Eg:- To get all recordings that are older than or equal to 100 days old, use recording_storage_duration\__gte=100
     *                         <br /> recording_storage_duration\__lt: lt stands for lesser than. The format expected is an integer value. Eg:- To get all recordings that are newer than 100 days, use recording_storage_duration\__lt=100
     *                         <br /> recording_storage_duration\__lte: lte stands for lesser than or equal. The format expected is an integer value. Eg:- To get all recordings that are newer than or equal to 100 days old, use recording_storage_duration\__lte=100
     *                         <br /> Note: The above filters can be combined to get recordings that started in a particular time range.
     *   + [int] limit - Used to display the number of results per page. The maximum number of results that can be fetched is 20.
     *   + [int] offset - Denotes the number of value items by which the results should be offset. Eg:- If the result contains a 1000 values and limit is set to 10 and offset is set to 705, then values 706 through 715 are displayed in the results. This parameter is also used for pagination of the results.
     * @return ResourceList
     */
    protected function getList($optionalArgs = [])
    {
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );

        $recordings = [];

        foreach ($response->getContent()['objects'] as $recording) {

            $newRecording = new Recording(
                $this->client, $recording, $this->pathParams['authId']);
            array_push($recordings, $newRecording);
        }
        return new ResourceList(
            $this->client, $response->getContent()['meta'], $recordings);
    }

    /**
     * Return a recording instance
     *
     * @param $recordingId
     * @return Recording
     * @throws PlivoValidationException
     */
    public function get($recordingId)
    {
        if (ArrayOperations::checkNull([$recordingId])) {
            throw
            new PlivoValidationException(
                'recording id is mandatory');
        }
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->fetch(
            $this->uri . $recordingId .'/',
            $optionalArgs
        );

        return new Recording(
            $this->client, $response->getContent(),
            $this->pathParams['authId']);
    }

    /**
     * Delete a recording
     *
     * @param string $recordingId
     * @throws PlivoValidationException
     */
    public function delete($recordingId)
    {
        if (ArrayOperations::checkNull([$recordingId])) {
            throw
            new PlivoValidationException(
                'recording id is mandatory');
        }
        $optionalArgs['isVoiceRequest'] = true;
        $this->client->delete(
            $this->uri . $recordingId . '/',
            $optionalArgs
        );
    }
}