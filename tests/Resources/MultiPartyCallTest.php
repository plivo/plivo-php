<?php

namespace Resources;


use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;

class MultiPartyCallTest extends BaseTestCase{
    function testMPCList(){
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/',
            []
        );
        $body = file_get_contents(__DIR__ . '/../Mocks/multiPartyCallsListResponse.json');
        $this->mock(new PlivoResponse($request,200, $body));
        $actual = $this->client->multipartyCalls->list();

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testMPCGet(){
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/uuid_ca8e8a44-48e1-445d-afd5-1fcccdbccd9d/',
            []
        );
        $body = file_get_contents(__DIR__ . '/../Mocks/multiPartyCallsGetResponse.json');
        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->multipartyCalls->get(['uuid' => 'ca8e8a44-48e1-445d-afd5-1fcccdbccd9d']);
        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testMPCAddParticipant(){
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/name_Voice/Participant/',
            [
                'role'=> 'Agent',
                'call_uuid'=> '1234-5678-4321-0987',
                'call_status_callback_method'=> 'POST',
                'confirm_key_sound_method'=> 'GET',
                'dial_music'=> 'Real',
                'ring_timeout'=> 45,
                'delay_dial'=> 0,
                'max_duration'=> 14400,
                'max_participants'=> 10,
                'record_min_member_count'=> 1,
                'wait_music_method'=> 'GET',
                'agent_hold_music_method'=> 'GET',
                'customer_hold_music_method'=> 'GET',
                'recording_callback_method'=> 'GET',
                'status_callback_method'=> 'GET',
                'on_exit_action_method'=> 'POST',
                'record'=> false,
                'record_file_format'=> 'mp3',
                'status_callback_events'=> 'mpc-state-changes,participant-state-changes',
                'stay_alone'=> false,
                'coach_mode'=> true,
                'mute'=> false,
                'hold'=> false,
                'start_mpc_on_enter'=> true,
                'end_mpc_on_exit'=> false,
                'relay_dtmf_inputs'=> false,
                'enter_sound'=> 'beep:1',
                'enter_sound_method'=> 'GET',
                'exit_sound'=> 'beep:2',
                'exit_sound_method'=> 'GET',
                'start_recording_audio_method'=> 'GET',
                'stop_recording_audio_method'=> 'GET'
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/multiPartyCallsAddParticipantResponse.json');

        $this->mock(new PlivoResponse($request,201, $body));
        $actual = $this->client->multiPartyCalls->addParticipant('Agent', ['friendly_name' => 'Voice', 'call_uuid' => '1234-5678-4321-0987']);

        $this->assertRequest($request);
        self::assertNotNull($actual);
        self::assertNotNull($actual['calls']);
        self::assertEquals($actual['message'], "add participant action initiated");
    }

    function testMPCStart(){
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/name_Voice/',
            ['status' => 'active']
        );

        $this->mock(new PlivoResponse($request,204));
        $actual = $this->client->multiPartyCalls->start(['friendly_name' => 'Voice']);

        $this->assertRequest($request);

        self::assertNull($actual['error']);
    }

    function testMPCEnd(){
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/name_Voice/',
            []
        );

        $this->mock(new PlivoResponse($request,204));
        $actual = $this->client->multiPartyCalls->stop(['friendly_name' => 'Voice']);

        $this->assertRequest($request);
        self::assertNull($actual['error']);
    }

    function testMPCStartRecording(){
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/name_Voice/Record/',
            ['file_format'=> 'wav',
                'recording_callback_url'=> 'https://plivo.com/status',
                'recording_callback_method'=> 'POST']
        );
        $body = file_get_contents(__DIR__ . '/../Mocks/multiPartyCallsStartRecordingResponse.json');

        $this->mock(new PlivoResponse($request,202, $body));
        $actual = $this->client->multiPartyCalls->startRecording(['friendly_name' => 'Voice', 'file_format' => 'wav',
                'recording_callback_url'=> 'https://plivo.com/status',
                'recording_callback_method'=> 'POST']
        );
        $this->assertRequest($request);
        self::assertNotNull($actual);
    }

    function testMPCStopRecording(){
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/name_Voice/Record/',
            []
        );

        $this->mock(new PlivoResponse($request,204));
        $actual = $this->client->multiPartyCalls->stopRecording(['friendly_name' => 'Voice']);
        $this->assertRequest($request);
        self::assertNull($actual['error']);
    }

    function testMPCPauseRecording(){
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/name_Voice/Record/Pause/',
            []
        );

        $this->mock(new PlivoResponse($request,204));
        $actual = $this->client->multiPartyCalls->pauseRecording(['friendly_name' => 'Voice']);
        $this->assertRequest($request);
        self::assertNull($actual['error']);
    }

    function testMPCResumeRecording(){
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/name_Voice/Record/Resume/',
            []
        );

        $this->mock(new PlivoResponse($request,204));
        $actual = $this->client->multiPartyCalls->resumeRecording(['friendly_name' => 'Voice']);
        $this->assertRequest($request);
        self::assertNull($actual['error']);
    }

    function testMPCListParticipants(){
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/uuid_12345678-90123456/Participant/',
            []
        );
        $body = file_get_contents(__DIR__ . '/../Mocks/multiPartyCallsListParticipantsResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));
        $actual = $this->client->multiPartyCalls->listParticipants(['uuid' => '12345678-90123456']);
        $this->assertRequest($request);
        self::assertNotNull($actual);
    }

    function testMPCUpdateParticipant(){
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/uuid_12345678-90123456/Participant/10/',
            ['hold'=>false, 'mute'=> false]
        );
        $body = file_get_contents(__DIR__ . '/../Mocks/multiPartyCallsUpdateParticipantResponse.json');

        $this->mock(new PlivoResponse($request,202, $body));
        $actual = $this->client->multiPartyCalls->updateParticipant(10, ['uuid' => '12345678-90123456', 'hold'=>false, 'mute'=> false]);
        $this->assertRequest($request);
        self::assertNotNull($actual);
    }

    function testMPCKickParticipant(){
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/uuid_12345678-90123456/Participant/10/',
            []
        );
        $this->mock(new PlivoResponse($request,204));
        $actual = $this->client->multiPartyCalls->kickParticipant(10, ['uuid' => '12345678-90123456']);
        $this->assertRequest($request);
        self::assertNull($actual['error']);
    }

    function testMPCGetParticipant(){
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/uuid_12345678-90123456/Participant/10/',
            []
        );
        $body = file_get_contents(__DIR__ . '/../Mocks/multiPartyCallsGetParticipantResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));
        $actual = $this->client->multiPartyCalls->getParticipant(10, ['uuid' => '12345678-90123456']);
        $this->assertRequest($request);
        self::assertNotNull($actual);
    }

    function testMPCStartParticipantRecording(){
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/uuid_12345678-90123456/Participant/10/Record/',
            ['file_format'=> 'wav',
                'recording_callback_url'=> 'https://plivo.com/status',
                'recording_callback_method'=> 'POST']
        );
        $body = file_get_contents(__DIR__ . '/../Mocks/multiPartyCallsStartParticipantRecordingResponse.json');

        $this->mock(new PlivoResponse($request,200));
        $actual = $this->client->multiPartyCalls->startParticipantRecording(10, ['uuid' => '12345678-90123456',
            'file_format'=> 'wav',
            'recording_callback_url'=> 'https://plivo.com/status',
            'recording_callback_method'=> 'POST']);
        $this->assertRequest($request);
        self::assertNotNull($actual);
    }

    function testMPCStopParticipantRecording(){
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/uuid_12345678-90123456/Participant/10/Record/',
            []
        );

        $this->mock(new PlivoResponse($request,204));
        $actual = $this->client->multiPartyCalls->stopParticipantRecording(10, ['uuid' => '12345678-90123456']);
        $this->assertRequest($request);
        self::assertNotNull($actual);
    }

    function testMPCPauseParticipantRecording(){
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/uuid_12345678-90123456/Participant/10/Record/Pause/',
            []
        );

        $this->mock(new PlivoResponse($request,204));
        $actual = $this->client->multiPartyCalls->pauseParticipantRecording(10, ['uuid' => '12345678-90123456']);
        $this->assertRequest($request);
        self::assertNotNull($actual);
    }

    function testMPCResumeParticipantRecording(){
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/uuid_12345678-90123456/Participant/10/Record/Resume/',
            []
        );

        $this->mock(new PlivoResponse($request,204));
        $actual = $this->client->multiPartyCalls->resumeParticipantRecording(10, ['uuid' => '12345678-90123456']);
        $this->assertRequest($request);
        self::assertNotNull($actual);
    }

    function testMPCStartPlayAudio(){
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/uuid_12345678-90123456/Member/10/Play/',
            ['url' => 'https://s3.amazonaws.com/XXX/XXX.mp3']
        );
        $body = file_get_contents(__DIR__ . '/../Mocks/multiPartyCallsStartPlayAudioResponse.json');

        $this->mock(new PlivoResponse($request,202, $body));
        $actual = $this->client->multiPartyCalls->startPlayAudio(10, "https://s3.amazonaws.com/XXX/XXX.mp3", ['uuid' => '12345678-90123456']);
        $this->assertRequest($request);
        self::assertNotNull($actual);
    }

    function testMPCStopPlayAudio(){
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/MultiPartyCall/uuid_12345678-90123456/Member/10/Play/',
            []
        );

        $this->mock(new PlivoResponse($request,204));
        $actual = $this->client->multiPartyCalls->stopPlayAudio(10, ['uuid' => '12345678-90123456']);
        $this->assertRequest($request);
        self::assertNotNull($actual);
    }
}