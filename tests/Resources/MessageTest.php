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

        $actual = $this->client->messages->create("+919999999999", ["+919012345678"], "Test");

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    public function testMessageGet()
    {
        $messageUuid = "5b40a428-bfc7-4daf-9d06-726c558bf3b8";
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
    }

    public function testMediaGet()
    {
        $messageUuid = "5b40a428-bfc7-4daf-9d06-726c558bf3b8";
        $mediaid = "973a04bd-cb2c-4de2-b9f2-5b54f9d33e6f";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Message/'.$messageUuid.'/Media/'.$mediaid.'/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/mediaResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->messages->get($messageUuid).getMedia($mediaid);

        $this->assertRequest($request);

        self::assertNotNull($actual);

        self::assertEquals($actual->messageUuid, $messageUuid);
    }
    public function testMediaList()
    {
        $messageUuid = "5b40a428-bfc7-4daf-9d06-726c558bf3b8";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Message/'.$messageUuid.'/Media/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/mediaListResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->messages->get($messageUuid).listMedia();

        $this->assertRequest($request);

        self::assertNotNull($actual);

    }
    
    function testMessageList()
    {
        $request = new PlivoRequest(
            'Get',
            'Account/MAXXXXXXXXXXXXXXXXXX/Message/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/messageListResponse.json');
        
        $this->mock(new PlivoResponse($request,202, $body));
        
        $actual = $this->client->messages->list;
        
        $this->assertRequest($request);
        
        self::assertNotNull($actual);
    }

}