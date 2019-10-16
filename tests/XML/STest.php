<?php
namespace XML;

use Plivo\XML\Response;
use Plivo\Tests\BaseTestCase;

/**
 * Class STest
 * @package Plivo\Tests\XML
 */
class STest extends BaseTestCase 
{
    
    function testAddS()
    {
        $response = new Response();
        $params1 = array(
            'language' => 'en-IN',
            'voice' => 'Polly.Aditi'  
        );

        $response->addSpeak('Hello,',$params1)
            ->addS('Welcome to Plivo');
        $ssml = $response->toXML(true);
        self::assertNotNull($ssml);

        self::assertXmlStringEqualsXmlFile(__DIR__ . '/../Mocks/sSpeak.xml',$ssml);
    }

    function testExceptionAddS()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US' 
        );

        $response->addSpeak('Hello,',$params1)
            ->addS('');
    }

    function testExceptionSSMLSupported()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US' 
        );

        $response->addSpeak('Hello,',$params1)
            ->addS('Welcome to Plivo');
    }

}