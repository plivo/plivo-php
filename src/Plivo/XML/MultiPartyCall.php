<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;
use Plivo\Util\MPCUtils;
/**
 * Class Conference
 * @package Plivo\XML
 */
class MultiPartyCall extends Element {
    protected $nestables = [];

    protected $valid_attributes = [
        'role', 'maxDuration', 'maxParticipants', 'waitMusicUrl',
        'waitMusicMethod', 'agentHoldMusicUrl', 'agentHoldMusicMethod',
        'customerHoldMusicUrl', 'customerHoldMusicMethod', 'record',
        'recordFileFormat', 'recordingCallbackUrl', 'recordingCallbackMethod',
        'statusCallbackEvents', 'statusCallbackUrl', 'statusCallbackMethod',
        'stayAlone', 'coachMode', 'mute', 'hold', 'startMpcOnEnter', 'endMpcOnExit',
        'enterSound', 'enterSoundMethod', 'exitSound', 'exitSoundMethod',
        'onExitActionUrl', 'onExitActionMethod', 'relayDTMFInputs',
        'startRecordingAudio', 'startRecordingAudioMethod', 'stopRecordingAudio', 'stopRecordingAudioMethod',
        'recordMinMemberCount'
    ];

    /**
     * Conference constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        parent::__construct($body, $attributes);
        $VALID_ROLE_VALUES = ['agent', 'supervisor', 'customer'];
        $VALID_METHOD_VALUES = ['GET', 'POST'];
        $VALID_RECORD_FILE_FORMAT_VALUES = ['mp3', 'wav'];
        if (!$body) {
            throw new PlivoXMLException("No MultiPartyCall name set for ".$this->getName());
        }
        if(isset($attributes['role']) and !in_array(strtolower($attributes['role']), $VALID_ROLE_VALUES, true)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['role']. ' for role');
        }
        elseif (!isset($attributes['role'])){
            throw new PlivoXMLException('role not mentioned : possible values - Agent / Supervisor / Customer');
        }
        if(isset($attributes['maxDuration']) and ($attributes['maxDuration'] < 300 or $attributes['maxDuration'] > 28800)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['maxDuration']. ' for maxDuration');
        }
        elseif (!isset($attributes['maxDuration'])){
            $attributes['maxDuration'] = 14400;
        }
        if(isset($attributes['maxParticipants']) and ($attributes['maxParticipants'] < 2 or $attributes['maxParticipants'] > 10)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['maxParticipants']. ' for maxParticipants');
        }
        elseif (!isset($attributes['maxParticipants'])){
            $attributes['maxParticipants'] = 10;
        }
        if(isset($attributes['recordMinMemberCount']) and ($attributes['recordMinMemberCount'] < 1 or $attributes['recordMinMemberCount'] > 2)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['recordMinMemberCount']. ' for recordMinMemberCount');
        }
        elseif (!isset($attributes['recordMinMemberCount'])){
            $attributes['recordMinMemberCount'] = 1;
        }
        if(isset($attributes['waitMusicMethod']) and !in_array(strtoupper($attributes['waitMusicMethod']), $VALID_METHOD_VALUES, true)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['waitMusicMethod']. ' for waitMusicMethod');
        }
        elseif (!isset($attributes['waitMusicMethod'])){
            $attributes['waitMusicMethod'] = 'GET';
        }
        if(isset($attributes['agentHoldMusicMethod']) and !in_array(strtoupper($attributes['agentHoldMusicMethod']), $VALID_METHOD_VALUES, true)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['agentHoldMusicMethod']. ' for agentHoldMusicMethod');
        }
        elseif (!isset($attributes['agentHoldMusicMethod'])){
            $attributes['agentHoldMusicMethod'] = 'GET';
        }
        if(isset($attributes['customerHoldMusicMethod']) and !in_array(strtoupper($attributes['customerHoldMusicMethod']), $VALID_METHOD_VALUES, true)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['customerHoldMusicMethod']. ' for customerHoldMusicMethod');
        }
        elseif (!isset($attributes['customerHoldMusicMethod'])){
            $attributes['customerHoldMusicMethod'] = 'GET';
        }
        if(isset($attributes['record']) and is_bool($attributes['record'])){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['record']. ' for record');
        }
        elseif (!isset($attributes['record'])){
            $attributes['record'] = false;
        }
        if(isset($attributes['recordFileFormat']) and !in_array(strtolower($attributes['recordFileFormat']), $VALID_RECORD_FILE_FORMAT_VALUES, true)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['recordFileFormat']. ' for recordFileFormat');
        }
        elseif (!isset($attributes['recordFileFormat'])){
            $attributes['recordFileFormat'] = 'mp3';
        }
        if(isset($attributes['recordingCallbackMethod']) and !in_array(strtoupper($attributes['recordingCallbackMethod']), $VALID_METHOD_VALUES, true)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['recordingCallbackMethod']. ' for recordingCallbackMethod');
        }
        elseif (!isset($attributes['recordingCallbackMethod'])){
            $attributes['recordingCallbackMethod'] = 'GET';
        }
        if(isset($attributes['statusCallbackEvents']) and !MPCUtils::multiValidParam('statusCallbackEvents', $attributes['statusCallbackEvents'], ['string'], false, ['mpc-state-changes', 'participant-state-changes', 'participant-speak-events', 'participant-digit-input-events', 'add-participant-api-events'], true,',')){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['statusCallbackEvents']. ' for statusCallbackEvents');
        }
        elseif (!isset($attributes['statusCallbackEvents'])){
            $attributes['statusCallbackEvents'] = 'mpc-state-changes,participant-state-changes';
        }
        if(isset($attributes['statusCallbackMethod']) and !in_array(strtoupper($attributes['statusCallbackMethod']), $VALID_METHOD_VALUES, true)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['statusCallbackMethod']. ' for statusCallbackMethod');
        }
        elseif (!isset($attributes['statusCallbackMethod'])){
            $attributes['statusCallbackMethod'] = 'POST';
        }
        if(isset($attributes['stayAlone']) and is_bool($attributes['stayAlone'])){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['stayAlone']. ' for stayAlone');
        }
        elseif (!isset($attributes['stayAlone'])){
            $attributes['stayAlone'] = false;
        }
        if(isset($attributes['coachMode']) and is_bool($attributes['coachMode'])){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['coachMode']. ' for coachMode');
        }
        elseif (!isset($attributes['coachMode'])){
            $attributes['coachMode'] = true;
        }
        if(isset($attributes['mute']) and is_bool($attributes['mute'])){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['mute']. ' for mute');
        }
        elseif (!isset($attributes['mute'])){
            $attributes['mute'] = false;
        }
        if(isset($attributes['hold']) and is_bool($attributes['hold'])){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['hold']. ' for hold');
        }
        elseif (!isset($attributes['hold'])){
            $attributes['hold'] = false;
        }
        if(isset($attributes['startMpcOnEnter']) and is_bool($attributes['startMpcOnEnter'])){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['startMpcOnEnter']. ' for startMpcOnEnter');
        }
        elseif (!isset($attributes['startMpcOnEnter'])){
            $attributes['startMpcOnEnter'] = true;
        }
        if(isset($attributes['endMpcOnExit']) and is_bool($attributes['endMpcOnExit'])){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['endMpcOnExit']. ' for endMpcOnExit');
        }
        elseif (!isset($attributes['endMpcOnExit'])){
            $attributes['endMpcOnExit'] = false;
        }
        if(isset($attributes['enterSound']) and !MPCUtils::isOneAmongStringUrl('enterSound', $attributes['enterSound'], false, ['beep:1', 'beep:2', 'none'])){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['enterSound']. ' for enterSound');
        }
        elseif (!isset($attributes['enterSound'])){
            $attributes['enterSound'] = 'beep:1';
        }
        if(isset($attributes['enterSoundMethod']) and !in_array(strtoupper($attributes['enterSoundMethod']), $VALID_METHOD_VALUES, true)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['enterSoundMethod']. ' for enterSoundMethod');
        }
        elseif (!isset($attributes['enterSoundMethod'])){
            $attributes['enterSoundMethod'] = 'GET';
        }
        if(isset($attributes['exitSound']) and !MPCUtils::isOneAmongStringUrl('exitSound', $attributes['exitSound'], false, ['beep:1', 'beep:2', 'none'])){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['exitSound']. ' for exitSound');
        }
        elseif (!isset($attributes['exitSound'])){
            $attributes['exitSound'] = 'beep:2';
        }
        if(isset($attributes['exitSoundMethod']) and !in_array(strtoupper($attributes['exitSoundMethod']), $VALID_METHOD_VALUES, true)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['exitSoundMethod']. ' for exitSoundMethod');
        }
        elseif (!isset($attributes['exitSoundMethod'])){
            $attributes['exitSoundMethod'] = 'GET';
        }
        if(isset($attributes['onExitActionMethod']) and !in_array(strtoupper($attributes['onExitActionMethod']), $VALID_METHOD_VALUES, true)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['onExitActionMethod']. ' for onExitActionMethod');
        }
        elseif (!isset($attributes['onExitActionMethod'])){
            $attributes['onExitActionMethod'] = 'POST';
        }
        if(isset($attributes['relayDTMFInputs']) and is_bool($attributes['relayDTMFInputs'])){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['relayDTMFInputs']. ' for relayDTMFInputs');
        }
        elseif (!isset($attributes['relayDTMFInputs'])){
            $attributes['relayDTMFInputs'] = false;
        }
        if(isset($attributes['waitMusicUrl']) and !MPCUtils::validUrl('waitMusicUrl', $attributes['waitMusicUrl'], false)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['waitMusicUrl']. ' for waitMusicUrl');
        }
        if(isset($attributes['agentHoldMusicUrl']) and !MPCUtils::validUrl('agentHoldMusicUrl', $attributes['agentHoldMusicUrl'], false)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['agentHoldMusicUrl']. ' for agentHoldMusicUrl');
        }
        if(isset($attributes['customerHoldMusicUrl']) and !MPCUtils::validUrl('customerHoldMusicUrl', $attributes['customerHoldMusicUrl'], false)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['customerHoldMusicUrl']. ' for customerHoldMusicUrl');
        }
        if(isset($attributes['recordingCallbackUrl']) and !MPCUtils::validUrl('recordingCallbackUrl', $attributes['recordingCallbackUrl'], false)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['recordingCallbackUrl']. ' for recordingCallbackUrl');
        }
        if(isset($attributes['statusCallbackUrl']) and !MPCUtils::validUrl('statusCallbackUrl', $attributes['statusCallbackUrl'], false)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['statusCallbackUrl']. ' for statusCallbackUrl');
        }
        if(isset($attributes['onExitActionUrl']) and !MPCUtils::validUrl('onExitActionUrl', $attributes['onExitActionUrl'], false)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['onExitActionUrl']. ' for onExitActionUrl');
        }
        if(isset($attributes['startRecordingAudio']) and !MPCUtils::validUrl('startRecordingAudio', $attributes['startRecordingAudio'], false)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['startRecordingAudio']. ' for startRecordingAudio');
        }
        if(isset($attributes['stopRecordingAudio']) and !MPCUtils::validUrl('stopRecordingAudio', $attributes['stopRecordingAudio'], false)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['stopRecordingAudio']. ' for stopRecordingAudio');
        }
        if(isset($attributes['startRecordingAudioMethod']) and !in_array(strtoupper($attributes['startRecordingAudioMethod']), $VALID_METHOD_VALUES, true)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['startRecordingAudioMethod']. ' for startRecordingAudioMethod');
        }
        elseif (!isset($attributes['startRecordingAudioMethod'])){
            $attributes['startRecordingAudioMethod'] = 'GET';
        }
        if(isset($attributes['stopRecordingAudioMethod']) and !in_array(strtoupper($attributes['stopRecordingAudioMethod']), $VALID_METHOD_VALUES, true)){
            throw new PlivoXMLException('Invalid attribute value ' . $attributes['stopRecordingAudioMethod']. ' for stopRecordingAudioMethod');
        }
        elseif (!isset($attributes['stopRecordingAudioMethod'])){
            $attributes['stopRecordingAudioMethod'] = 'GET';
        }
    }
}