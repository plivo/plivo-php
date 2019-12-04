<?php
namespace XML;

use Plivo\XML\Response;
use Plivo\Tests\BaseTestCase;

/**
 * Class SayAsTest
 * @package Plivo\Tests\XML
 */
class SayAsTest extends BaseTestCase 
{
    
    function testAddProsody()
    {
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'interpret-as' => 'date',
            'format' => 'dmy'
        );

        $response->addSpeak('I was born on ',$params1)
            ->addSayAs('12-31-1977',$params2);
        $ssml = $response->toXML(true);
        // $actual = new \DOMDocument;
        // $actual->loadXML($ssml);

        self::assertNotNull($ssml);

        self::assertXmlStringEqualsXmlFile(__DIR__ . '/../Mocks/sayAsSpeak.xml',$ssml);
    }

    function testExceptionAddProsody()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'interpret-as' => 'date',
            'format' => 'dmy'
        );

        $response->addSpeak('I was born on ',$params1)
            ->addSayAs('',$params2);
    }

    function testExceptionAttributeInterpretAsAddProsody()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'interpretas' => 'date'
        );

        $response->addSpeak('I was born on ',$params1)
            ->addSayAs('12-31-1977',$params2);
        $ssml = $response->toXML(true);
    }

    function testExceptionAttributeFormatAddProsody()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'formats' => 'mdy'
        );

        $response->addSpeak('I was born on ',$params1)
            ->addSayAs('12-31-1977',$params2);
        $ssml = $response->toXML(true);
    }

    function testExceptionAttributeInterpretAsValueAddProsody()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'interpret-as' => 'loud'
        );

        $response->addSpeak('I was born on ',$params1)
            ->addSayAs('12-31-1977',$params2);
        $ssml = $response->toXML(true);
    }

    function testExceptionAttributeFormatValueAddProsody()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'format' => 'mdyy'
        );

        $response->addSpeak('I was born on ',$params1)
            ->addSayAs('12-31-1977',$params2);
        $ssml = $response->toXML(true);
    }

    function testExceptionSSMLSupported()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US'
        );

        $params2 = array(
            'format' => 'mdyy'
        );

        $response->addSpeak('I was born on ',$params1)
            ->addSayAs('12-31-1977',$params2);
    }
}