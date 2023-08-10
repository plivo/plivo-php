<?php

namespace Plivo\Tests\Resources;




use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;


/**
 * Class MessageTest
 * @package Plivo\Tests\Resources
 */
class MessageTest extends BaseTestCase {

    public function testMessageCreateWithoutSrcPowerpackException()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoValidationException');
        $body = file_get_contents(__DIR__ . '/../Mocks/messageSendResponse.json');

        $this->mock(new PlivoResponse(new PlivoRequest(),200, $body));

        $this->client->messages->create(null, ["+919012345678"], "Test", [], null);

    }

    public function testMessageCreateWithSrcPowerpackException()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoValidationException');
        $body = file_get_contents(__DIR__ . '/../Mocks/messageSendResponse.json');

        $this->mock(new PlivoResponse(new PlivoRequest(),200, $body));

        $this->client->messages->create("+919999999999", ["+919012345678"], "Test", [], "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");

    }

    public function testMessageCreate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Message/',
            [
                "dst" => "+919012345678",
                "text" => "Test",
                "src" => "+919999999999"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/messageSendResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->messages->create("+919999999999", ["+919012345678"], "Test", [], null);

        self::assertNotNull($actual);
    }

    public function testnewMessageCreate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Message/',
            [
                "dst" => "+919012345678",
                "text" => "Test",
                "src" => "+919999999999"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/messageSendResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->messages->create([ "src" => "+919999999999", "dst" => "+919012345678", "text"  =>"Test"]);

        self::assertNotNull($actual);
    }

    public function testwhatsappTemplateMessageCreate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Message/',
            [
                "dst" => "+919012345678",
                "text" => "Test",
                "src" => "+919999999999"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/messageSendResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $template = '{
            "name": "hello_world",
            "language": "en_US",
            "components": null
          }';

        $actual = $this->client->messages->create([ "src" => "+919999999999", "dst" => "+919012345678", "template"  =>$template]);

        self::assertNotNull($actual);
    }

    public function testMessageGet()
    {
        $messageUuid = "5b40a428-bfc7-4daf-9d06-726c558bf3b8";
        $requesterIP = "192.168.1.1";
        $dltEntityID = "1234";
        $dltTemplateID = "5678";
        $dltTemplateCategory = "service_implicit";
        $conversationID = "9876";
        $conversationOrigin = "utility";
        $conversationExpirationTimestamp = "2023-08-03 23:02:00+05:30";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Message/'.$messageUuid.'/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/messageGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->messages->get($messageUuid);

        $this->assertRequest($request);

        self::assertNotNull($actual);

        self::assertEquals($actual->messageUuid, $messageUuid);
        self::assertEquals($actual->requesterIP, $requesterIP);
        self::assertEquals($actual->dltEntityID, $dltEntityID);
        self::assertEquals($actual->dltTemplateID, $dltTemplateID);
        self::assertEquals($actual->dltTemplateCategory, $dltTemplateCategory);
        self::assertEquals($actual->conversationID, $conversationID);
        self::assertEquals($actual->conversationOrigin, $conversationOrigin);
        self::assertEquals($actual->conversationExpirationTimestamp, $conversationExpirationTimestamp);
    }

    public function testMessageGetwithPowerpack()
    {
        $messageUuid = "5b40a428-bfc7-4daf-9d06-726c558bf3b8";
        $expected_ppk = "15c01cc2-4b9f-4d3b-bd15-3c4b38984cc4";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Message/'.$messageUuid.'/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/messageGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->messages->get($messageUuid);

        self::assertEquals($actual->powerpackID, $expected_ppk);
    }
    public function testMediaList()
    {
        $messageUuid = "5b40a428-bfc7-4daf-9d06-726c558bf3b8";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Message/'.$messageUuid.'/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/messageGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->messages->get($messageUuid);
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Message/'.$messageUuid.'/Media/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/mediaListResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $mediaList = $actual->listMedia();
        self::assertNotNull($mediaList);

    }
    
    function testMessageList()
    {
        $requesterIP1 = "192.168.1.1";
        $requesterIP2 = "192.168.1.20";
        $dltEntityID = "9876";
        $dltTemplateID = "5432";
        $dltTemplateCategory = "promotional";
        $conversationID = "1234";
        $conversationOrigin = "service";
        $conversationExpirationTimestamp = "2023-08-03 23:02:00+05:30";
        $request = new PlivoRequest(
            'Get',
            'Account/MAXXXXXXXXXXXXXXXXXX/Message/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/messageListResponse.json');
        
        $this->mock(new PlivoResponse($request,202, $body));
        
        $actual = $this->client->messages->list;
        
        $this->assertRequest($request);
        
        self::assertNotNull($actual);
        self::assertEquals($actual->resources[0]->requesterIP, $requesterIP1);
        self::assertEquals($actual->resources[19]->requesterIP, $requesterIP2);

        self::assertEquals($actual->resources[0]->dltEntityID, $dltEntityID);
        self::assertEquals($actual->resources[0]->dltTemplateID, $dltTemplateID);
        self::assertEquals($actual->resources[0]->dltTemplateCategory, $dltTemplateCategory);

        self::assertEquals($actual->resources[0]->conversationID, $conversationID);
        self::assertEquals($actual->resources[0]->conversationOrigin, $conversationOrigin);
        self::assertEquals($actual->resources[0]->conversationExpirationTimestamp, $conversationExpirationTimestamp);
        
        self::assertObjectNotHasAttribute('dltEntityID', $actual->resources[19]);
        self::assertObjectNotHasAttribute('dltTemplateID', $actual->resources[19]);
        self::assertObjectNotHasAttribute('dltTemplateCategory', $actual->resources[19]);

        self::assertObjectNotHasAttribute('conversationID', $actual->resources[19]);
        self::assertObjectNotHasAttribute('conversationOrigin', $actual->resources[19]);
        self::assertObjectNotHasAttribute('conversationExpirationTimestamp', $actual->resources[19]);
        
    }

}