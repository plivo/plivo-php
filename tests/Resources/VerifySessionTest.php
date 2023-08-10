<?php

namespace Plivo\Tests\Resources;

use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;


/**
 * Class VerifySessionTest
 * @package Plivo\Tests\Resources
 */
class VerifySessionTest extends BaseTestCase {


    public function testVerifySessionCreate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Verify/Session/',
            [
                "recipient" => "+919999999999"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/verifySessionCreateResponse.json');

        $this->mock(new PlivoResponse($request,202, $body));
        $actual = $this->client->verifySessions->create("+919999999999");
        self::assertNotNull($actual);
    }

    public function testVerifySessionCreateWithRecipientException()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoValidationException');

        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Verify/Session/',
            [
                "recipient" => "+919999999999"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/verifySessionCreateResponse.json');

        $this->mock(new PlivoResponse($request,202, $body));
        $actual = $this->client->verifySessions->create("");

    }

    public function testVerifySessionValidateWithSessionUUIDException()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoValidationException');

        $sessionUuid = "5b40a428-bfc7-4daf-9d06-726c558bf3b8";
        $otp = "999999";
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Verify/Session/'.$sessionUuid.'/',
            [
                "otp" => "999999"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/verifySessionValidateResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));
        $actual = $this->client->verifySessions->validate("", $otp);

    }

    public function testVerifySessionValidateWithOTPException()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoValidationException');

        $sessionUuid = "5b40a428-bfc7-4daf-9d06-726c558bf3b8";
        $otp = "999999";
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Verify/Session/'.$sessionUuid.'/',
            [
                "otp" => "999999"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/verifySessionValidateResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));
        $actual = $this->client->verifySessions->validate($sessionUuid, "");

    }



    public function testVerifySessionValidate()
    {
        $sessionUuid = "5b40a428-bfc7-4daf-9d06-726c558bf3b8";
        $otp = "999999";
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Verify/Session/'.$sessionUuid.'/',
            [
                "otp" => "999999"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/verifySessionValidateResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->verifySessions->validate($sessionUuid, $otp);
        self::assertNotNull($actual);
        self::assertEquals($actual->message, "session validated successfully.");

    }

    public function testVerifySessionGet()
    {
        $sessionUuid = "4124e518-a8c9-4feb-8cff-d86636ba9234";
        $requesterIP = "172.167.8.2";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Verify/Session/'.$sessionUuid.'/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/verifySessionGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->verifySessions->get($sessionUuid);
        $this->assertRequest($request);
        self::assertNotNull($actual);
        self::assertEquals($actual->sessionUuid, $sessionUuid);
        self::assertEquals($actual->requesterIP, $requesterIP);
    }

    public function testVerifySessionGetSessionUUIDException()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoValidationException');

        $sessionUuid = "4124e518-a8c9-4feb-8cff-d86636ba9234";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Verify/Session/'.$sessionUuid.'/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/verifySessionGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));
        $this->client->verifySessions->get("");
        
    }

    function testVerifySessionList()
    {
        $requesterIP1 = "110.226.182.196";
        $requesterIP2 = "110.226.182.196";
        $request = new PlivoRequest(
            'Get',
            'Account/MAXXXXXXXXXXXXXXXXXX/Verify/Session/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/verifySessionListResponse.json');
        
        $this->mock(new PlivoResponse($request,200, $body));
        
        $actual = $this->client->verifySessions->list();
        $this->assertRequest($request);
        self::assertNotNull($actual);
        self::assertEquals($actual->resources[0]->requesterIP, $requesterIP1);
        self::assertEquals($actual->resources[3]->requesterIP, $requesterIP2);
    }

}