<?php

namespace Resources;


use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;

/**
 * Class TollfreeVerificationTest
 * @package Resources
 */
class TollfreeVerificationTest extends BaseTestCase
{
    function testTollfreeVerificationList()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/TollfreeVerification/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/tollfreeVerificationListResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->tollfreeVerification->getList();

        $this->assertRequest($request);

        self::assertNotNull($actual);

        self::assertGreaterThan(0, count($actual->get()));
    }

    function testTollfreeVerificationCreate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/TollfreeVerification/',
            [
                    "number"=>"18554950186",
                    "usecase"=>"2FA",
                    "profile_uuid"=>"42f92135-6ec2-4110-8da4-71171f6aad44",
                    "optin_type"=>"VERBAL",
                    "volume"=> "100",
                    "usecase_summary"=>"hbv",
                    "message_sample"=> "message_sample",
                    "callback_url"=> "https://plivobin-prod-usw1.plivops.com/1pcfjrt1",
                    "callback_method"=> "POST",
                    "optin_image_url"=> "http://google.com",
                    "additional_information"=> "this is additional_information",
                    "extra_data"=>"this is extra_data"

            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/tollfreeVerificationCreateResponse.json');

        $this->mock(new PlivoResponse($request,201, $body));

        $actual = $this->client->tollfreeVerification->create('18554950186', '2FA', '42f92135-6ec2-4110-8da4-71171f6aad44', 'VERBAL', '100', 'hbv', 'message_sample', 'http://google.com', "wqw", "wqwq", "wqwqw", "wqwq");

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

