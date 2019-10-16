<?php
namespace XML;

use Plivo\XML\Response;
use Plivo\Tests\BaseTestCase;

/**
 * Class WTest
 * @package Plivo\Tests\XML
 */
class WTest extends BaseTestCase 
{
    
    function testAddW()
    {
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'interpret-as' => 'characters'
        );

        $params3 = array(
            'role' => 'amazon:VB'
        );

        $params4 = array(
            'role' => 'amazon:VBD'
        );

        $response->addSpeak('The word ',$params1)
            ->addSayAs('read',$params2)
            ->continueSpeak('may be interpreted as either the present simple form')
            ->addW('read',$params3)
            ->continueSpeak(', or the past participle form')
            ->addW('read',$params4);
        $ssml = $response->toXML(true);
        // $actual = new \DOMDocument;
        // $actual->loadXML($ssml);

        self::assertNotNull($ssml);

        self::assertXmlStringEqualsXmlFile(__DIR__ . '/../Mocks/wSpeak.xml',$ssml);
    }

    function testExceptionAddW()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'interpret-as' => 'character'
        );

        $params3 = array(
            'roles' => 'amazon:VB'
        );

        $params4 = array(
            'role' => 'amazon:VBD'
        );


        $response->addSpeak('The word ',$params1)
            ->addSayAs('read',$params2)
            ->continueSpeak('may be interpreted as either the present simple form')
            ->addW('',$params3)
            ->continueSpeak(', or the past participle form')
            ->addW('',$params4);
        $ssml = $response->toXML(true);
    }

    function testExceptionAttributeRoleAddW()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'interpret-as' => 'character'
        );

        $params3 = array(
            'roles' => 'amazon:VB'
        );

        $params4 = array(
            'role' => 'amazon:VBD'
        );


        $response->addSpeak('The word ',$params1)
            ->addSayAs('read',$params2)
            ->continueSpeak('may be interpreted as either the present simple form')
            ->addW('read',$params3)
            ->continueSpeak(', or the past participle form')
            ->addW('read',$params4);
        $ssml = $response->toXML(true);
    }

    function testExceptionAttributeRoleValueAddW()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'interpret-as' => 'character'
        );

        $params3 = array(
            'role' => 'amazon:V'
        );

        $params4 = array(
            'role' => 'amazon:VBD'
        );


        $response->addSpeak('The word ',$params1)
            ->addSayAs('read',$params2)
            ->continueSpeak('may be interpreted as either the present simple form')
            ->addW('read',$params3)
            ->continueSpeak(', or the past participle form')
            ->addW('read',$params4);
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
            'interpret-as' => 'character'
        );

        $params3 = array(
            'role' => 'amazon:VB'
        );

        $params4 = array(
            'role' => 'amazon:VBD'
        );
        $response->addSpeak('The word ',$params1)
            ->addSayAs('read',$params2)
            ->continueSpeak('may be interpreted as either the present simple form')
            ->addW('read',$params3)
            ->continueSpeak(', or the past participle form')
            ->addW('read',$params4);
    }
}
