<?php
namespace XML;

use Plivo\XML\Response;
use Plivo\Tests\BaseTestCase;

/**
 * Class BreakTest
 * @package Plivo\Tests\XML
 */
class BreakTest extends BaseTestCase 
{
    
    function testBreak()
    {
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $response->addSpeak('Hello,',$params1);
        $response->addBreak()
        ->continueSpeak('Welcome to Plivo');
        
        $ssml = $response->toXML(true);

        self::assertNotNull($ssml);

        self::assertXmlStringEqualsXmlFile(__DIR__ . '/../Mocks/break.xml',$ssml);
    }

    function testAttributeBreak()
    {
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );
        $params2 = array(
            'strength' => 'x-weak',
            'time' => '3s'  
        );
        $response = new Response();
        $response->addSpeak('Hello,',$params1);
        $response->addBreak($params2)
            ->continueSpeak('Welcome to Plivo');
        $ssml = $response->toXML(true);

        self::assertNotNull($ssml);
        self::assertXmlStringEqualsXmlFile(__DIR__ . '/../Mocks/paramBreak.xml',$ssml);
    }

    function testExceptionAttributeBreak()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );
        $params2 = array(
            'strength' => 'x-weak',
            'times' => '3s'  
        );
        $response = new Response();
        $response->addSpeak('Hello,',$params1);
        $response->addBreak($params2)
            ->continueSpeak('Welcome to Plivo');
    }

    function testExceptionSSMLSupported()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $params1 = array(
            'language' => 'en-US' 
        );
        $params2 = array(
            'strength' => 'x-weak',
            'times' => '3s'  
        );
        $response = new Response();
        $response->addSpeak('Hello,',$params1);
        $response->addBreak($params2);
    }
}