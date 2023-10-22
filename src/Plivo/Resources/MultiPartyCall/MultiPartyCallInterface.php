<?php

namespace Plivo\Resources\MultiPartyCall;

use Plivo\Exceptions\PlivoValidationException;
use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;
use Plivo\Util\MPCUtils;

class MultiPartyCallInterface extends ResourceInterface
{
    function __construct(BaseClient $plivoClient, $authId){
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/MultiPartyCall/";
    }

    public function mpcId($uuid = null, $friendlyName = null){
        if(is_null($uuid) and is_null($friendlyName)){
            throw new PlivoValidationException('Specify either multi party call friendly name or uuid');
        }
        if(!is_null($uuid) and !is_null($friendlyName)){
            throw new PlivoValidationException('Cannot specify both multi party call friendly name or uuid');
        }
        if($uuid){
            $identifier = 'uuid_'. $uuid;
        }
        else{
            $identifier = 'name_'. $friendlyName;
        }
        return $identifier;
    }

    public function getList(array $optionalArgs = []){
        if(isset($optionalArgs['sub_account'])){
            MPCUtils::validSubAccount($optionalArgs['sub_account']);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendlyName', $optionalArgs['friendly_name'], ['string'], false);
        }
        if(isset($optionalArgs['status'])){
            MPCUtils::validParam('status', strtolower($optionalArgs['status']), ['string'], false, ['initialized', 'active', 'ended']);
        }
        if(isset($optionalArgs['termination_cause_code'])){
            MPCUtils::validParam('terminationCauseCode', $optionalArgs['termination_cause_code'], ['integer'], false);
        }
        if(isset($optionalArgs['end_time__gt'])){
            MPCUtils::validDateFormat('end_time__gt', $optionalArgs['end_time__gt'], false);
        }
        if(isset($optionalArgs['end_time__gte'])){
            MPCUtils::validDateFormat('end_time__gte', $optionalArgs['end_time__gte'], false);
        }
        if(isset($optionalArgs['end_time__lt'])){
            MPCUtils::validDateFormat('end_time__lt', $optionalArgs['end_time__lt'], false);
        }
        if(isset($optionalArgs['end_time__lte'])){
            MPCUtils::validDateFormat('end_time__lte', $optionalArgs['end_time__lte'], false);
        }
        if(isset($optionalArgs['creation_time__gt'])){
            MPCUtils::validDateFormat('creation_time__gt', $optionalArgs['creation_time__gt'], false);
        }
        if(isset($optionalArgs['creation_time__gte'])){
            MPCUtils::validDateFormat('creation_time__gte', $optionalArgs['creation_time__gte'], false);
        }
        if(isset($optionalArgs['creation_time__lt'])){
            MPCUtils::validDateFormat('creation_time__lt', $optionalArgs['creation_time__lt'], false);
        }
        if(isset($optionalArgs['creation_time__lte'])){
            MPCUtils::validDateFormat('creation_time__lte', $optionalArgs['creation_time__lte'], false);
        }
        if(isset($optionalArgs['limit'])){
            MPCUtils::validRange('limit', $optionalArgs['limit'], false, 1, 20);
        }
        if(isset($optionalArgs['offset'])){
            MPCUtils::validRange('offset', $optionalArgs['offset'], false, 0);
        }
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );
        return $response->getContent();
    }

    public function get(array $optionalArgs = []){
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->fetch(
            $this->uri. $mpcId. "/",
            $optionalArgs
        );
        return $response->getContent();
    }

    public function addParticipant($role, array $optionalArgs = []){
        if(empty($role)) {
            throw new PlivoValidationException('role is mandatory');
        }
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        if((isset($optionalArgs['from']) and isset($optionalArgs['to'])) and (isset($optionalArgs['call_uuid']))){
            throw new PlivoValidationException('cannot specify call_uuid when (from, to) is provided');
        }
        if((!isset($optionalArgs['from']) and !isset($optionalArgs['to'])) and (!isset($optionalArgs['call_uuid']))) {
            throw new PlivoValidationException('specify either callUuid or (from, to)');
        }
        if((!isset($optionalArgs['from']) or !isset($optionalArgs['to'])) and (!isset($optionalArgs['call_uuid']))){
            throw new PlivoValidationException('specify (from, to) when not adding an existing callUuid to multi party participant');
        }
        MPCUtils::validParam('role',strtolower($role), ['string'], true, ['agent', 'supervisor', 'customer']);
        if(isset($optionalArgs['from'])){
            MPCUtils::validParam('from', $optionalArgs['from'], ['string'], false);
        }
        if(isset($optionalArgs['to'])){
            MPCUtils::validParam('to', $optionalArgs['to'], ['string'], false);
            MPCUtils::validMultipleDestinationNos('to', $optionalArgs['to'], ['role' => $role, 'delimiter' => '<', 'agentLimit' => 20]);
            $optionalArgs['to'] = preg_replace('/\s+/', '', $optionalArgs['to']);
        }
        if(isset($optionalArgs['call_uuid'])){
            MPCUtils::validParam('callUuid', $optionalArgs['call_uuid'], ['string'], false);
        }
        if(isset($optionalArgs['caller_name'])){
            MPCUtils::validParam('callerName', $optionalArgs['caller_name'], ['string'], false);
            MPCUtils::validRange('callerName', strlen($optionalArgs['caller_name']), false, 0, 50);
        }
        elseif(isset($optionalArgs['from'])) {
            $optionalArgs['caller_name'] = $optionalArgs['from'];
        }
        if(isset($optionalArgs['call_status_callback_url'])){
            MPCUtils::validUrl('callStatusCallbackUrl', $optionalArgs['call_status_callback_url'], false);
        }
        if(isset($optionalArgs['call_status_callback_method'])){
            MPCUtils::validParam('callStatusCallbackMethod', strtoupper($optionalArgs['call_status_callback_method']), ['string'], false, ['GET', 'POST']);
        }
        else{
            $optionalArgs['call_status_callback_method'] = 'POST';
        }
        if(isset($optionalArgs['sip_headers'])){
            MPCUtils::validParam('sipHeaders', $optionalArgs['sip_headers'], ['string'], false);
        }
        if(isset($optionalArgs['confirm_key'])){
            MPCUtils::validParam('confirmKey', $optionalArgs['confirm_key'], ['string'], false, ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '#', '*']);
        }
        if(isset($optionalArgs['confirm_key_sound_url'])){
            MPCUtils::validUrl('confirmKeySoundUrl', $optionalArgs['confirm_key_sound_url'], false);
        }
        if(isset($optionalArgs['confirm_key_sound_method'])){
            MPCUtils::validParam('callStatusCallbackMethod', strtoupper($optionalArgs['confirm_key_sound_method']), ['string'], false, ['GET', 'POST']);
        }
        else{
            $optionalArgs['confirm_key_sound_method'] = 'GET';
        }
        if(isset($optionalArgs['dial_music'])){
            MPCUtils::isOneAmongStringUrl('dialMusic', $optionalArgs['dial_music'], false, ['real', 'none']);
        }
        else{
            $optionalArgs['dial_music'] = 'Real';
        }
        if(isset($optionalArgs['ring_timeout'])){
            MPCUtils::validParam('ringTimeout', $optionalArgs['ring_timeout'], ['string','integer'], false);
            if(is_string($optionalArgs['ring_timeout'])){
                MPCUtils::validMultipleDestinationIntegers('ringTimeout',$optionalArgs['ring_timeout']);
            }
        }
        else{
            $optionalArgs['ring_timeout'] = 45;
        }
        if(isset($optionalArgs['delay_dial'])){
            MPCUtils::validParam('delayDial', $optionalArgs['delay_dial'], ['string','integer'], false);
            if(is_string($optionalArgs['delay_dial'])){
                MPCUtils::validMultipleDestinationIntegers('delayDial',$optionalArgs['delay_dial']);
            }
        }
        else{
            $optionalArgs['delay_dial']=0;
        }
        if(isset($optionalArgs['max_duration'])){
            MPCUtils::validRange('maxDuration', $optionalArgs['max_duration'], false, 300, 28800);
        }
        else{
            $optionalArgs['max_duration'] = 14400;
        }
        if(isset($optionalArgs['max_participants'])){
            MPCUtils::validRange('maxParticipants', $optionalArgs['max_participants'], false, 2, 10);
        }
        else{
            $optionalArgs['max_participants'] = 10;
        }
        if(isset($optionalArgs['record_min_member_count'])){
            MPCUtils::validRange('recordMinMemberCount', $optionalArgs['record_min_member_count'], false, 1, 2);
        }
        else{
            $optionalArgs['record_min_member_count'] = 1;
        }
        if(isset($optionalArgs['wait_music_url'])){
            MPCUtils::validUrl('waitMusicUrl', $optionalArgs['wait_music_url'], false);
        }
        if(isset($optionalArgs['wait_music_method'])){
            MPCUtils::validParam('waitMusicMethod', strtoupper($optionalArgs['wait_music_method']), ['string'],false, ['GET', 'POST']);
        }
        else{
            $optionalArgs['wait_music_method'] = 'GET';
        }
        if(isset($optionalArgs['agent_hold_music_url'])){
            MPCUtils::validUrl('agentHoldMusicUrl', $optionalArgs['agent_hold_music_url'], false);
        }
        if(isset($optionalArgs['agent_hold_music_method'])){
            MPCUtils::validParam('agentHoldMusicMethod', strtoupper($optionalArgs['agent_hold_music_method']), ['string'],false, ['GET', 'POST']);
        }
        else{
            $optionalArgs['agent_hold_music_method'] = 'GET';
        }
        if(isset($optionalArgs['customer_hold_music_url'])){
            MPCUtils::validUrl('customerHoldMusicUrl', $optionalArgs['customer_hold_music_url'], false);
        }
        if(isset($optionalArgs['customer_hold_music_method'])){
            MPCUtils::validParam('customerHoldMusicMethod', strtoupper($optionalArgs['customer_hold_music_method']), ['string'],false, ['GET', 'POST']);
        }
        else{
            $optionalArgs['customer_hold_music_method'] = 'GET';
        }
        if(isset($optionalArgs['recording_callback_url'])){
            MPCUtils::validUrl('recordingCallbackUrl', $optionalArgs['recording_callback_url'], false);
        }
        if(isset($optionalArgs['recording_callback_method'])){
            MPCUtils::validParam('recordingCallbackMethod', strtoupper($optionalArgs['recording_callback_method']), ['string'],false, ['GET', 'POST']);
        }
        else{
            $optionalArgs['recording_callback_method'] = 'GET';
        }
        if(isset($optionalArgs['status_callback_url'])){
            MPCUtils::validUrl('statusCallbackUrl', $optionalArgs['status_callback_url'], false);
        }
        if(isset($optionalArgs['status_callback_method'])){
            MPCUtils::validParam('statusCallbackMethod', strtoupper($optionalArgs['status_callback_method']), ['string'],false, ['GET', 'POST']);
        }
        else{
            $optionalArgs['status_callback_method'] = 'GET';
        }
        if(isset($optionalArgs['on_exit_action_url'])){
            MPCUtils::validUrl('onExitActionUrl', $optionalArgs['on_exit_action_url'], false);
        }
        if(isset($optionalArgs['on_exit_action_method'])){
            MPCUtils::validParam('onExitActionMethod', strtoupper($optionalArgs['on_exit_action_method']), ['string'],false, ['GET', 'POST']);
        }
        else{
            $optionalArgs['on_exit_action_method'] = 'POST';
        }
        if(isset($optionalArgs['record'])){
            MPCUtils::validParam('record', $optionalArgs['record'], ['boolean'],false);
        }
        else{
            $optionalArgs['record'] = false;
        }
        if(isset($optionalArgs['record_file_format'])){
            MPCUtils::validParam('recordFileFormat', strtolower($optionalArgs['record_file_format']), ['string'],false, ['mp3', 'wav']);
        }
        else{
            $optionalArgs['record_file_format'] = 'mp3';
        }
        if(isset($optionalArgs['status_callback_events'])){
            MPCUtils::multiValidParam('statusCallbackEvents', strtolower($optionalArgs['status_callback_events']),['string'], false, ['mpc-state-changes', 'participant-state-changes', 'participant-speak-events', 'participant-digit-input-events', 'add-participant-api-events'], true,',');
        }
        else{
            $optionalArgs['status_callback_events'] = 'mpc-state-changes,participant-state-changes';
        }
        if(isset($optionalArgs['stay_alone'])){
            MPCUtils::validParam('stayAlone', $optionalArgs['stay_alone'], ['boolean'], false);
        }
        else{
            $optionalArgs['stay_alone'] = false;
        }
        if(isset($optionalArgs['coach_mode'])){
            MPCUtils::validParam('coachMode', $optionalArgs['coach_mode'], ['boolean'], false);
        }
        else{
            $optionalArgs['coach_mode'] = true;
        }
        if(isset($optionalArgs['mute'])){
            MPCUtils::validParam('mute', $optionalArgs['mute'], ['boolean'], false);
        }
        else{
            $optionalArgs['mute'] = false;
        }
        if(isset($optionalArgs['hold'])){
            MPCUtils::validParam('hold', $optionalArgs['hold'], ['boolean'], false);
        }
        else{
            $optionalArgs['hold'] = false;
        }
        if(isset($optionalArgs['start_mpc_on_enter'])){
            MPCUtils::validParam('startMpcOnEnter', $optionalArgs['start_mpc_on_enter'], ['boolean'], false);
        }
        else{
            $optionalArgs['start_mpc_on_enter'] = true;
        }
        if(isset($optionalArgs['end_mpc_on_exit'])){
            MPCUtils::validParam('endMpcOnExit', $optionalArgs['end_mpc_on_exit'], ['boolean'], false);
        }
        else{
            $optionalArgs['end_mpc_on_exit'] = false;
        }
        if(isset($optionalArgs['relay_dtmf_inputs'])){
            MPCUtils::validParam('relayDTMFInputs', $optionalArgs['relay_dtmf_inputs'], ['boolean'], false);
        }
        else{
            $optionalArgs['relay_dtmf_inputs'] = false;
        }
        if(isset($optionalArgs['enter_sound'])){
            MPCUtils::isOneAmongStringUrl('enterSound', $optionalArgs['enter_sound'], false, ['beep:1', 'beep:2', 'none']);
        }
        else{
            $optionalArgs['enter_sound'] = 'beep:1';
        }
        if(isset($optionalArgs['enter_sound_method'])){
            MPCUtils::validParam('enterSoundMethod', strtoupper($optionalArgs['enter_sound_method']), ['string'], false, ['GET', 'POST']);
        }
        else{
            $optionalArgs['enter_sound_method'] = 'GET';
        }
        if(isset($optionalArgs['exit_sound'])){
            MPCUtils::isOneAmongStringUrl('exitSound', $optionalArgs['exit_sound'], false, ['beep:1', 'beep:2', 'none']);
        }
        else{
            $optionalArgs['exit_sound'] = 'beep:2';
        }
        if(isset($optionalArgs['exit_sound_method'])){
            MPCUtils::validParam('exitSoundMethod', strtoupper($optionalArgs['exit_sound_method']), ['string'], false, ['GET', 'POST']);
        }
        else{
            $optionalArgs['exit_sound_method'] = 'GET';
        }
        if(isset($optionalArgs['start_recording_audio'])){
            MPCUtils::validUrl('startRecordingAudio', $optionalArgs['start_recording_audio'], false);
        }
        if(isset($optionalArgs['start_recording_audio_method'])){
            MPCUtils::validParam('startRecordingAudioMethod', strtoupper($optionalArgs['start_recording_audio_method']), ['string'], false, ['GET', 'POST']);
        }
        else{
            $optionalArgs['start_recording_audio_method'] = 'GET';
        }
        if(isset($optionalArgs['stop_recording_audio'])){
            MPCUtils::validUrl('stopRecordingAudio', $optionalArgs['stop_recording_audio'], false);
        }
        if(isset($optionalArgs['stop_recording_audio_method'])){
            MPCUtils::validParam('stopRecordingAudioMethod', strtoupper($optionalArgs['stop_recording_audio_method']), ['string'], false, ['GET', 'POST']);
        }
        else{
            $optionalArgs['stop_recording_audio_method'] = 'GET';
        }
        $mandatoryArgs = ['role' => $role];
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->update(
            $this->uri. $mpcId. "/Participant/",
            array_merge($mandatoryArgs, $optionalArgs)
        );
        return $response->getContent();
    }

    public function start(array $optionalArgs = []){
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        $response = $this->client->update(
            $this->uri. $mpcId. "/",
            ['status' => 'active', 'isVoiceRequest' => true]
        );
        return $response->getContent();
    }

    public function stop(array $optionalArgs = []){
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->delete($this->uri. $mpcId. "/",
            $optionalArgs
        );
        return $response->getContent();
    }

    public function startRecording(array $optionalArgs = []){
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        if(isset($optionalArgs['file_format'])){
            MPCUtils::validParam('fileFormat', strtolower($optionalArgs['file_format']), ['string'],false, ['mp3', 'wav']);
        }
        else{
            $optionalArgs['file_format'] = 'mp3';
        }
        if(isset($optionalArgs['recording_callback_url'])){
            MPCUtils::validUrl('recordingCallbackUrl', $optionalArgs['recording_callback_url'], false);
        }
        if(isset($optionalArgs['recording_callback_method'])){
            MPCUtils::validParam('recordingCallbackMethod', strtoupper($optionalArgs['recording_callback_method']), ['string'], false, ['GET', 'POST']);
        }
        else{
            $optionalArgs['recording_callback_method'] = 'POST';
        }
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->update(
            $this->uri. $mpcId. '/Record/',
            $optionalArgs
        );
        return $response->getContent();
    }

    public function stopRecording(array $optionalArgs = []){
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->delete(
            $this->uri. $mpcId. '/Record/',
            $optionalArgs
        );
        return $response->getContent();
    }

    public function pauseRecording(array $optionalArgs = []){
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->update(
            $this->uri. $mpcId. '/Record/Pause/',
            $optionalArgs
        );
        return $response->getContent();
    }

    public function resumeRecording(array $optionalArgs = []){
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->update(
            $this->uri. $mpcId. '/Record/Resume/',
            $optionalArgs
        );
        return $response->getContent();
    }

    public function startParticipantRecording($participantId, array $optionalArgs = []){
        MPCUtils::validParam('participantId', $participantId, ['string', 'integer'], true);
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        if(isset($optionalArgs['file_format'])){
            MPCUtils::validParam('fileFormat', strtolower($optionalArgs['file_format']), ['string'],false, ['mp3', 'wav']);
        }
        else{
            $optionalArgs['file_format'] = 'mp3';
        }
        if(isset($optionalArgs['recording_callback_url'])){
            MPCUtils::validUrl('recordingCallbackUrl', $optionalArgs['recording_callback_url'], false);
        }
        if(isset($optionalArgs['recording_callback_method'])){
            MPCUtils::validParam('recordingCallbackMethod', strtoupper($optionalArgs['recording_callback_method']), ['string'], false, ['GET', 'POST']);
        }
        else{
            $optionalArgs['recording_callback_method'] = 'POST';
        }
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->update(
            $this->uri. $mpcId. '/Participant/'. $participantId. '/Record/',
            $optionalArgs
        );
        return $response->getContent();
    }

    public function stopParticipantRecording($participantId, array $optionalArgs = []){
        MPCUtils::validParam('participantId', $participantId, ['string', 'integer'], true);
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->delete(
            $this->uri. $mpcId. '/Participant/'. $participantId. '/Record/',
            $optionalArgs
        );
        return $response->getContent();
    }

    public function pauseParticipantRecording($participantId, array $optionalArgs = []){
        MPCUtils::validParam('participantId', $participantId, ['string', 'integer'], true);
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->update(
            $this->uri. $mpcId. '/Participant/'. $participantId. '/Record/Pause/',
            $optionalArgs
        );
        return $response->getContent();
    }

    public function resumeParticipantRecording($participantId, array $optionalArgs = []){
        MPCUtils::validParam('participantId', $participantId, ['string', 'integer'], true);
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->update(
            $this->uri. $mpcId. '/Participant/'. $participantId. '/Record/Resume/',
            $optionalArgs
        );
        return $response->getContent();
    }

    public function listParticipants(array $optionalArgs = []){
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        if(isset($optionalArgs['call_uuid'])){
            MPCUtils::validParam('callUuid', $optionalArgs['call_uuid'], ['string'], false);
        }
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->fetch(
            $this->uri. $mpcId. '/Participant/',
            $optionalArgs
        );
        return $response->getContent();
    }

    public function updateParticipant($participantId, array $optionalArgs = []){
        MPCUtils::validParam('participantId', $participantId, ['string', 'integer'], true);
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        if(isset($optionalArgs['coach_mode'])){
            MPCUtils::validParam('coachMode', $optionalArgs['coach_mode'], ['boolean'], false);
        }
        if(isset($optionalArgs['mute'])){
            MPCUtils::validParam('mute', $optionalArgs['mute'], ['boolean'], false);
        }
        if(isset($optionalArgs['hold'])){
            MPCUtils::validParam('hold', $optionalArgs['hold'], ['boolean'], false);
        }
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->update(
            $this->uri. $mpcId. '/Participant/'. $participantId. '/',
            $optionalArgs
        );
        return $response->getContent();
    }

    public function kickParticipant($participantId, array $optionalArgs = []){
        MPCUtils::validParam('participantId', $participantId, ['string', 'integer'], true);
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->delete(
            $this->uri. $mpcId. '/Participant/'. $participantId. '/',
            $optionalArgs
        );
        return $response->getContent();
    }

    public function getParticipant($participantId, array $optionalArgs = []){
        MPCUtils::validParam('participantId', $participantId, ['string', 'integer'], true);
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->fetch(
            $this->uri. $mpcId. '/Participant/'. $participantId. '/',
            $optionalArgs
        );
        return $response->getContent();
    }

    public function startPlayAudio($participantId, $url, array $optionalArgs = []){
        MPCUtils::validParam('participantId', $participantId, ['string', 'integer'], true);
        MPCUtils::validUrl('url', $url, true);
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        $mandatoryArgs = ['url' => $url];
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->update(
            $this->uri. $mpcId. '/Member/'. $participantId. '/Play/',
            array_merge($mandatoryArgs, $optionalArgs)
        );
        return $response->getContent();
    }

    public function stopPlayAudio($participantId, array $optionalArgs = []){
        MPCUtils::validParam('participantId', $participantId, ['string', 'integer'], true);
        if(isset($optionalArgs['uuid'])){
            MPCUtils::validParam('uuid', $optionalArgs['uuid'], ['string'],false);
        }
        if(isset($optionalArgs['friendly_name'])){
            MPCUtils::validParam('friendly_name', $optionalArgs['friendly_name'], ['string'],false);
        }
        if(!isset($optionalArgs['uuid'])){
            $optionalArgs['uuid'] = null;
        }
        if(!isset($optionalArgs['friendly_name'])){
            $optionalArgs['friendly_name'] = null;
        }
        $mpcId = self::mpcId($optionalArgs['uuid'], $optionalArgs['friendly_name']);
        unset($optionalArgs['uuid']);
        unset($optionalArgs['friendly_name']);
        $optionalArgs['isVoiceRequest'] = true;
        $response = $this->client->delete(
            $this->uri. $mpcId. '/Member/'. $participantId. '/Play/',
            $optionalArgs
        );
        return $response->getContent();
    }
}