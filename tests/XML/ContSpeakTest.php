<?php
namespace XML;

use Plivo\XML\Response;
use Plivo\Tests\BaseTestCase;

/**
 * Class ContSpeakTest
 * @package Plivo\Tests\XML
 */
class ContSpeakTest extends BaseTestCase 
{
    
    function testContSpeak()
    {
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $response->addSpeak('Hello,',$params1)
            ->continueSpeak('Welcome to Plivo');
        $ssml = $response->toXML(true);

        self::assertNotNull($ssml);

        self::assertXmlStringEqualsXmlFile(__DIR__ . '/../Mocks/contSpeak.xml',$ssml);
    }
}