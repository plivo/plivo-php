<?php
namespace XML;

use Plivo\XML\Response;
use Plivo\Tests\BaseTestCase;

/**
 * Class ProsodyTest
 * @package Plivo\Tests\XML
 */
class ProsodyTest extends BaseTestCase 
{
    
    function testAddProsody()
    {
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'volume' => 'loud',
            'rate' => 'medium',
            'pitch' => 'high'
        );

        $response->addSpeak('Although in some cases, it might help your audience to ',$params1)
            ->addProsody('slow the speaking rate slightly to aid in comprehension.',$params2);
        $ssml = $response->toXML(true);
        // $actual = new \DOMDocument;
        // $actual->loadXML($ssml);

        self::assertNotNull($ssml);

        self::assertXmlStringEqualsXmlFile(__DIR__ . '/../Mocks/prosodySpeak.xml',$ssml);
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
            'volume' => 'loud',
            'rate' => 'medium',
            'pitch' => 'high'
        );

        $response->addSpeak('Although in some cases, it might help your audience to ',$params1)
            ->addProsody('',$params2);
        $ssml = $response->toXML(true);
    }

    function testExceptionAttributeVolumeAddProsody()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'volumes' => 'loud',
            'rate' => 'medium',
            'pitch' => 'high'
        );

        $response->addSpeak('Although in some cases, it might help your audience to ',$params1)
            ->addProsody('slow the speaking rate slightly to aid in comprehension.',$params2);
        $ssml = $response->toXML(true);
    }

    function testExceptionAttributeRateAddProsody()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'volume' => 'loud',
            'rates' => 'medium',
            'pitch' => 'high'
        );

        $response->addSpeak('Although in some cases, it might help your audience to ',$params1)
            ->addProsody('slow the speaking rate slightly to aid in comprehension.',$params2);
        $ssml = $response->toXML(true);
    }

    function testExceptionAttributePitchAddProsody()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'volume' => 'loud',
            'rate' => 'medium',
            'pitchs' => 'high'
        );

        $response->addSpeak('Although in some cases, it might help your audience to ',$params1)
            ->addProsody('slow the speaking rate slightly to aid in comprehension.',$params2);
        $ssml = $response->toXML(true);
    }

    function testExceptionAttributeVolumeValueAddProsody()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'volume' => 'louds',
            'rate' => 'medium',
            'pitch' => 'high'
        );

        $response->addSpeak('Although in some cases, it might help your audience to ',$params1)
            ->addProsody('slow the speaking rate slightly to aid in comprehension.',$params2);
        $ssml = $response->toXML(true);
    }

    function testExceptionAttributeRateValueAddProsody()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'volume' => 'loud',
            'rate' => 'mediums',
            'pitch' => 'high'
        );

        $response->addSpeak('Although in some cases, it might help your audience to ',$params1)
            ->addProsody('slow the speaking rate slightly to aid in comprehension.',$params2);
        $ssml = $response->toXML(true);
    }

    function testExceptionAttributePitchValueAddProsody()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'volume' => 'loud',
            'rate' => 'medium',
            'pitch' => 'highs'
        );

        $response->addSpeak('Although in some cases, it might help your audience to ',$params1)
            ->addProsody('slow the speaking rate slightly to aid in comprehension.',$params2);
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
            'volume' => 'loud',
            'rate' => 'medium',
            'pitchs' => 'high'
        );

        $response->addSpeak('Although in some cases, it might help your audience to ',$params1)
            ->addProsody('slow the speaking rate slightly to aid in comprehension.',$params2);
    }
}