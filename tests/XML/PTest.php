<?php
namespace XML;

use Plivo\XML\Response;
use Plivo\Tests\BaseTestCase;

/**
 * Class PTest
 * @package Plivo\Tests\XML
 */
class PTest extends BaseTestCase 
{
    
    function testAddP()
    {
        $response = new Response();
        $params1 = array(
            'language' => 'en-IN',
            'voice' => 'Polly.Aditi'  
        );

        $response->addSpeak('Hello,',$params1)
            ->addP('Welcome to Plivo');
        $ssml = $response->toXML(true);
        self::assertNotNull($ssml);

        self::assertXmlStringEqualsXmlFile(__DIR__ . '/../Mocks/pSpeak.xml',$ssml);
    }

    function testExceptionAddP()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-IN',
            'voice' => 'Polly.Aditi'  
        );

        $response->addSpeak('Hello,',$params1)
            ->addP('');
    }

    function testExceptionSSMLSupported()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US' 
        );

        $response->addSpeak('Hello,',$params1)
            ->addP('Welcome to Plivo');
    }

}