<?php
/**
 * Created by PhpStorm.
 * User: kritarth
 * Date: 25/05/17
 * Time: 4:02 PM
 */

namespace Plivo\Resources\Conference;


use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class Conference
 * @package Plivo\Resources\Conference
 * @property string $conferenceName Name of the conference
 * @property string $conferenceRunTime Run time of the conference
 * @property string $conferenceMemberCount Number of members in the conference
 * @property array $members members
 */
class Conference extends Resource
{
    /**
     * Conference constructor.
     * @param BaseClient $client
     * @param $response
     * @param $authId
     * @param $conferenceName
     */
    public function __construct(
        BaseClient $client, $response, $authId, $conferenceName)
    {
        parent::__construct($client);

        $this->properties = [
            'conferenceName' => $response['conference_name'],
            'conferenceRunTime' => $response['conference_run_time'],
            'conferenceMemberCount' => $response['conference_member_count'],
            'members' => $response['members']
        ];

        $this->pathParams = [
            'authId' => $authId,
            'conferenceName' => $conferenceName
        ];

        $this->id = $conferenceName;
    }

    /**
     * @return null|ConferenceInterface
     */
    protected function proxyToInterface()
    {
        if (!$this->interface) {
            $this->interface = new ConferenceInterface(
                $this->client, $this->pathParams['authId']);
        }

        return $this->interface;
    }

    /**
     * @return \Plivo\Resources\ResponseDelete
     */
    public function delete()
    {
        return $this->proxyToInterface()->delete(
            $this->id
        );
    }

    /**
     * @param array $members
     * @return \Plivo\Resources\ResponseUpdate
     */
    public function muteMember(array $members)
    {
        return $this->proxyToInterface()->muteMember(
            $this->id,
            $members
        );
    }

    /**
     * @param array $members
     * @return \Plivo\Resources\ResponseDelete
     */
    public function UnMuteMember(array $members)
    {
        return $this->proxyToInterface()->unMuteMember(
            $this->id,
            $members
        );
    }

    /**
     * @param array $members
     * @param $url
     * @return \Plivo\Resources\ResponseUpdate
     */
    public function startPlaying(array $members, $url)
    {
        return $this->proxyToInterface()->startPlaying(
            $this->id,
            $members,
            $url
        );
    }

    /**
     * @param array $members
     * @param $text
     * @return \Plivo\Resources\ResponseUpdate
     */
    public function startSpeaking(array $members, $text)
    {
        return $this->proxyToInterface()->startSpeaking(
            $this->id,
            $members,
            $text
        );
    }

    /**
     * @param array $optionalArgs
     * @return ConferenceRecording
     */
    public function startRecording(array $optionalArgs)
    {
        return $this->proxyToInterface()->startRecording(
            $this->id,
            $optionalArgs
        );
    }

    /**
     * @param array $members
     * @return \Plivo\Resources\ResponseDelete
     */
    public function stopPlaying(array $members)
    {
        return $this->proxyToInterface()->stopPlaying(
            $this->id,
            $members
        );
    }

    /**
     * @param array $members
     * @return \Plivo\Resources\ResponseDelete
     */
    public function stopSpeaking(array $members)
    {
        return $this->proxyToInterface()->stopSpeaking(
            $this->id,
            $members
        );
    }

    /**
     * @return \Plivo\Resources\ResponseDelete
     */
    public function stopRecording()
    {
        return $this->proxyToInterface()->stopRecording(
            $this->id
        );
    }

    /**
     * @param array $members
     * @return \Plivo\Resources\ResponseUpdate
     */
    public function createDeaf(array $members)
    {
        return $this->proxyToInterface()->makeDeaf(
            $this->id,
            $members
        );
    }

    /**
     * @param array $members
     * @return \Plivo\Resources\ResponseDelete
     */
    public function deleteDeaf(array $members)
    {
        return $this->proxyToInterface()->enableHearing(
            $this->id,
            $members
        );
    }
}