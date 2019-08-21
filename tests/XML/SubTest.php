<?php
namespace XML;

use Plivo\XML\Response;
use Plivo\Tests\BaseTestCase;

/**
 * Class SubTest
 * @package Plivo\Tests\XML
 */
class SubTest extends BaseTestCase 
{
    
    function testAddSub()
    {
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'alias' => 'Mercury'
        );

        $response->addSpeak('My favorite chemical element is ',$params1)
            ->addSub('Hg',$params2)
            ->continueSpeak(', because it looks so shiny.');
        $ssml = $response->toXML(true);
        // $actual = new \DOMDocument;
        // $actual->loadXML($ssml);

        self::assertNotNull($ssml);

        self::assertXmlStringEqualsXmlFile(__DIR__ . '/../Mocks/subSpeak.xml',$ssml);
    }

    function testExceptionAddSub()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'alia' => 'Mercury'
        );

        $response->addSpeak('My favorite chemical element is ',$params1)
            ->addSub('',$params2)
            ->continueSpeak(', because it looks so shiny.');
        $ssml = $response->toXML(true);
    }

    function testExceptionAttributeAliasAddSub()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'alia' => 'Mercury'
        );

        $response->addSpeak('My favorite chemical element is ',$params1)
            ->addSub('Hg',$params2)
            ->continueSpeak(', because it looks so shiny.');
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
            'alias' => 'Mercury'
        );
        $response->addSpeak('My favorite chemical element is ',$params1)
            ->addSub('Hg',$params2)
            ->continueSpeak(', because it looks so shiny.');
    }
}