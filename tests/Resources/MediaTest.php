<?php

namespace Plivo\Tests\Resources;




use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;


/**
 * Class MediaTest
 * @package Plivo\Tests\Resources
 */
class MediaTest extends BaseTestCase {

    public function testMediaGet()
    {
        $mediaID = "31e7de16-de14-4009-b31f-9c9653c5f319";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Media/'.$mediaID.'/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/mediaGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->media->get($mediaID);

        $this->assertRequest($request);

        self::assertNotNull($actual);

        self::assertEquals($actual->mediaID, $mediaID);
    }

    public function testMediaList()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Media/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/mmsmediaListResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->media->list();

        $this->assertRequest($request);

        self::assertNotNull($actual);

    }

}