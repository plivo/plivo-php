<?php

namespace Resources;


use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;

/**
 * Class RecordingTest
 * @package Resources
 */
class RecordingTest extends BaseTestCase
{
    function testPricingGet()
    {
        $recording = "c2186400-1c8c-11e4-a664-0026b945b52x";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Recording/'.$recording.'/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/recordingGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->recordings->get($recording);

        $this->assertRequest($request);

        self::assertNotNull($actual);

        self::assertEquals($recording, $actual->id);
    }

    function testPricingList()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Recording/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/recordingListResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->recordings->list;

        $this->assertRequest($request);

        self::assertNotNull($actual);

        foreach($actual->resources as $object) {
            if($object) {
                self::assertEquals("noname", $object->properties['conferenceName']);
            }    
        }
        
    }
    
    function testRecordingDelete()
    {
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/Recording/cxcxcx/',
            []);
        $body = '{}';
        
        $this->mock(new PlivoResponse($request,200, $body));
        
        $actual = $this->client->recordings->delete("cxcxcx");
        
        $this->assertRequest($request);
        
        self::assertNull($actual);
    }
}