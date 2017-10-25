<?php

namespace Resources;


use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;

/**
 * Class ConferenceTest
 * @package Resources
 */
class ConferenceTest extends BaseTestCase
{
    function testConferenceDetails()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Conference/dfshjkasfhjkasfhjkashf/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/conferenceGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->conferences->get("dfshjkasfhjkasfhjkashf");

        $this->assertRequest($request);

        self::assertNotNull($actual);

        self::assertEquals($actual->getId(), "dfshjkasfhjkasfhjkashf");
    }

    function testConferenceList()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Conference/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/conferenceListResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->conferences->list;

        $this->assertRequest($request);

        self::assertNotNull($actual);

        self::assertGreaterThan(0, count($actual));
    }

    function testConferenceDeleteAll()
    {
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/Conference/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/conferenceDeleteAllResponse.json');

        $this->mock(new PlivoResponse($request,204, $body));

        $actual = $this->client->conferences->deleteAll();

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testConferenceDelete()
    {
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/Conference/asdasdasdasd/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/conferenceDeleteAllResponse.json');

        $this->mock(new PlivoResponse($request,204, $body));

        $actual = $this->client->conferences->delete("asdasdasdasd");

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testConferenceMemberMute()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Conference/asdasdasdasd/Member/123/Mute/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/conferenceMemberMuteCreateResponse.json');

        $this->mock(new PlivoResponse($request,201, $body));

        $actual = $this->client->conferences->muteMember("asdasdasdasd", ['123']);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testConferenceMemberUnMute()
    {
        $request = new PlivoRequest(
            'Delete',
            'Account/MAXXXXXXXXXXXXXXXXXX/Conference/asdasdasdasd/Member/123/Mute/',
            []);

        $this->mock(new PlivoResponse($request,201, ""));

        $actual = $this->client->conferences->unMuteMember("asdasdasdasd", ['123']);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testConferenceMemberDeaf()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Conference/asdasdasdasd/Member/123/Deaf/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/conferenceMemberMuteCreateResponse.json');

        $this->mock(new PlivoResponse($request,201, $body));

        $actual = $this->client->conferences->makeDeaf("asdasdasdasd", ['123']);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testConferenceMemberHear()
    {
        $request = new PlivoRequest(
            'Delete',
            'Account/MAXXXXXXXXXXXXXXXXXX/Conference/asdasdasdasd/Member/123,111/Deaf/',
            []);

        $this->mock(new PlivoResponse($request,201, ""));

        $actual = $this->client->conferences->enableHearing("asdasdasdasd", ['123','111']);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testConferenceMemberKick()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Conference/asdasdasdasd/Member/123/Kick/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/conferenceMemberMuteCreateResponse.json');

        $this->mock(new PlivoResponse($request,201, $body));

        $actual = $this->client->conferences->kickMember("asdasdasdasd", '123');

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testConferenceMemberPlay()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Conference/asdasdasdasd/Member/123,111,1/Play/',
            ['url'=>""]);
        $body = file_get_contents(__DIR__ . '/../Mocks/conferenceMemberMuteCreateResponse.json');

        $this->mock(new PlivoResponse($request,201, $body));

        $actual = $this->client->conferences->startPlaying("asdasdasdasd", ['123','111','1'], "");

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testConferenceMemberSpeak()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Conference/asdasdasdasd/Member/123/Speak/',
            ["text"=>"this is the text"]);
        $body = file_get_contents(__DIR__ . '/../Mocks/conferenceMemberMuteCreateResponse.json');

        $this->mock(new PlivoResponse($request,201, $body));

        $actual = $this->client->conferences->startSpeaking("asdasdasdasd", ['123'], "this is the text");

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testConferenceMemberPlayDelete()
    {
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/Conference/asdasdasdasd/Member/123,111,1/Play/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/conferenceMemberMuteCreateResponse.json');

        $this->mock(new PlivoResponse($request,204, $body));

        $actual = $this->client->conferences->stopPlaying("asdasdasdasd", ['123','111','1']);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testConferenceMemberSpeakDelete()
    {
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/Conference/asdasdasdasd/Member/123/Speak/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/conferenceMemberMuteCreateResponse.json');

        $this->mock(new PlivoResponse($request,204, $body));

        $actual = $this->client->conferences->stopSpeaking("asdasdasdasd", ['123']);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testConferenceRecord()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Conference/asdasdasdasd/Record/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/conferenceRecordCreateResponse.json');

        $this->mock(new PlivoResponse($request,201, $body));

        $actual = $this->client->conferences->startRecording("asdasdasdasd");

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }
}
