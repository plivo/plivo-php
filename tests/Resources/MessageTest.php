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

    public function testMessageCreateException()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoValidationException');
        $body = file_get_contents(__DIR__ . '/../Mocks/messageSendResponse.json');

        $this->mock(new PlivoResponse(new PlivoRequest(),200, $body));

        $this->client->messages->create(null, ["+919012345678"], "Test");

    }

    public function testMessageCreate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Message/',
            [
                "src" => "+919999999999",
                "dst" => "+919012345678",
                "text" => "Test"
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