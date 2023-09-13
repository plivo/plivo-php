<?php

namespace Resources;


use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;

/**
 * Class MaskingSessionlTest
 * @package Resources
 */
class MaskingSessionTest extends BaseTestCase
{
    function testCreateMaskingSession()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Masking/Session/',
            [
                'first_party' => '919999999999',
                'second_party' => '919999999998'
                
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/maskingSessionCreateResponse.json');

        $this->mock(new PlivoResponse($request,201, $body));

        $actual = $this->client->maskingSessions->createMaskingSession(
            '919999999999', '919999999998');

        $this->assertRequest($request);

        self::assertNotNull($actual);

        // $actual = json_decode($actual);

        self::assertEquals($actual->message, "Session created");
        self::assertEquals($actual->apiId, "1c8beb2c-01bf-4649-b0fb-5e3bd7836311");
    }

    function testUpdateMaskingSession()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Masking/Session/',
            [
                '4d04c52e-cea3-4458-bbdb-0bfc314ee7cd5',
                array(
                    'call_time_limit' => 1600,
                    'record_file_format' => 'wav'
                )
                
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/maskingSessionUpdateResponse.json');

        $this->mock(new PlivoResponse($request,201, $body));

        $actual = $this->client->maskingSessions->updateMaskingSession(
            '4d04c52e-cea3-4458-bbdb-0bfc314ee7cd5',
            array('call_time_limit'=>1600,'record_file_format' => 'wav'
                 ));

        self::assertNotNull($actual);

        // $actual = json_decode($actual);

        self::assertEquals($actual->message, "Session updated");
        self::assertEquals($actual->apiId, "b5506536-83d0-498f-929f-4427cb6ca391");
    }


    function testDeleteMaskingSession()
    {
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/Masking/Session/4d04c52e-cea3-4458-bbdb-0bfc314ee7cd5',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/maskingSessionDeleteResponse.json');

        $this->mock(new PlivoResponse($request,204, $body));

        $actual = $this->client->maskingSessions->deleteMaskingSession("4d04c52e-cea3-4458-bbdb-0bfc314ee7cd5");;

        self::assertNotNull($actual);
    }


    function testGetMaskingSession()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Masking/Session/4d04c52e-cea3-4458-bbdb-0bfc314ee7cd5/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/maskingSessionGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->maskingSessions->getMaskingSession("4d04c52e-cea3-4458-bbdb-0bfc314ee7cd5");

        $this->assertRequest($request);

        self::assertNotNull($actual);

        self::assertEquals($actual->getId(), "4d04c52e-cea3-4458-bbdb-0bfc314ee7cd5");
    }

    function testListMaskingSession()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Masking/Session/',
            [
                array('first_party'=>'916361728680',
                    'second_party' => '917708772011'
            )]);
        $body = file_get_contents(__DIR__ . '/../Mocks/maskingSessionListResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->maskingSessions->listMaskingSession(array('first_party'=>'916361728680',
        'second_party' => '917708772011'));

        self::assertNotNull($actual);

        self::assertEquals($actual->meta, array('total_count'=>2, 'limit'=>20, 'next'=>null, 'offset'=>0, 'previous'=>null));
    }

    
    
}
