<?php
/**
 * Created by PhpStorm.
 * User: kritarth
 * Date: 25/05/17
 * Time: 5:50 PM
 */

namespace Plivo\Resources\Conference;


use Plivo\Resources\ResponseUpdate;

/**
 * Class ConferenceRecording
 * @package Plivo\Resources\Conference
 */
class ConferenceRecording extends ResponseUpdate
{
    protected $url;
    protected $recordingId;

    /**
     * ConferenceRecording constructor.
     * @param $message
     * @param $url
     * @param $recordingId
     */
    public function __construct($apiId, $message, $recordingId, $url)
    {
        parent::__construct($apiId, $message);

        $this->url = $url;
        $this->recordingId = $recordingId;
    }

}