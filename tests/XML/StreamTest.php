<?php
namespace XML;

use Plivo\XML\Response;
use Plivo\Tests\BaseTestCase;

/**
 * Class StreamTest
 * @package Plivo\Tests\XML
 */
class StreamTest extends BaseTestCase
{

    function testAddStream()
    {
        $response = new Response();
        $params1 = array(
            'bidirectional' => true,
            'extraHeaders' => "a=1,b=2"
        );

        $response->addStream("wss://mystream.ngrok.io/audiostream",$params1);
        $ssml = $response->toXML(true);

        self::assertNotNull($ssml);

        self::assertXmlStringEqualsXmlFile(__DIR__ . '/../Mocks/stream.xml',$ssml);
    }

}
