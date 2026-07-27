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
                    "optin_image_url"=> "http://google.com",
                    "callback_url"=> "https://plivobin-prod-usw1.plivops.com/1pcfjrt1",
                    "callback_method"=> "POST",
                    "additional_information"=> "this is additional_information",
                    "extra_data"=>"this is extra_data",
                    "terms_and_conditions_link"=> "https://example.com/terms",
                    "privacy_policy_link"=> "https://example.com/privacy",
                    "optin_message"=> "this is optin_message",
                    "help_message"=> "this is help_message"

            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/tollfreeVerificationCreateResponse.json');

        $this->mock(new PlivoResponse($request,201, $body));

        $actual = $this->client->tollfreeVerification->create('18554950186', '2FA', '42f92135-6ec2-4110-8da4-71171f6aad44', 'VERBAL', '100', 'hbv', 'message_sample', 'http://google.com', "https://plivobin-prod-usw1.plivops.com/1pcfjrt1", "POST", "this is additional_information", "this is extra_data", "https://example.com/terms", "https://example.com/privacy", "this is optin_message", "this is help_message");

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    function testTollfreeVerificationUpdate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/TollfreeVerification/81fc8b2d-1ab8-47c9-7245-e454227b7b7b/',
            [
                    "usecase"=>"2FA",
                    "terms_and_conditions_link"=> "https://example.com/terms",
                    "privacy_policy_link"=> "https://example.com/privacy",
                    "optin_message"=> "this is optin_message",
                    "help_message"=> "this is help_message"
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/tollfreeVerificationUpdateResponse.json');

        $this->mock(new PlivoResponse($request,202, $body));

        $actual = $this->client->tollfreeVerification->update('81fc8b2d-1ab8-47c9-7245-e454227b7b7b', [
            "usecase"=>"2FA",
            "terms_and_conditions_link"=> "https://example.com/terms",
            "privacy_policy_link"=> "https://example.com/privacy",
            "optin_message"=> "this is optin_message",
            "help_message"=> "this is help_message"
        ]);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

}