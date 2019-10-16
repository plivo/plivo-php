<?php
namespace XML;

use Plivo\XML\Response;
use Plivo\Tests\BaseTestCase;

/**
 * Class PhonemeTest
 * @package Plivo\Tests\XML
 */
class PhonemeTest extends BaseTestCase 
{
    
    function testAddPhoneme()
    {
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'alphabet' => 'ipa',
            'ph' => "pɪˈkɑːn"
        );

        $response->addSpeak('You say, ',$params1)
            ->addPhoneme('pecan',$params2)
            ->continueSpeak('.')
            ->continueSpeak('I say, ')
            ->addPhoneme('pecan',array(
                'alphabet' => 'ipa',
                'ph' => "ˈpi.kæn"
            ))
            ->continueSpeak('.');
        $ssml = $response->toXML(true);
        // $actual = new \DOMDocument;
        // $actual->loadXML($ssml);

        self::assertNotNull($ssml);

        self::assertXmlStringEqualsXmlFile(__DIR__ . '/../Mocks/phonemeSpeak.xml',$ssml);
    }

    function testExceptionAddPhoneme()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'alphabet' => 'ipa',
            'ph' => "pɪˈkɑːn"
        );

        $response->addSpeak('You say, ',$params1)
            ->addPhoneme('pecan',$params2)
            ->continueSpeak('.')
            ->continueSpeak('I say, ')
            ->addPhoneme('',array(
                'alphabet' => 'ipa',
                'ph' => "ˈpi.kæn"
            ))
            ->continueSpeak('.');
        $ssml = $response->toXML(true);
    }

    function testExceptionAttributeAlphabetAddPhoneme()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'alphabet' => 'ipa',
            'ph' => "pɪˈkɑːn"
        );

        $response->addSpeak('You say, ',$params1)
            ->addPhoneme('pecan',$params2)
            ->continueSpeak('.')
            ->continueSpeak('I say, ')
            ->addPhoneme('pecan',array(
                'alphabets' => 'ipa',
                'ph' => "ˈpi.kæn"
            ))
            ->continueSpeak('.');
        $ssml = $response->toXML(true);
    }

    function testExceptionAttributeAlphabetValueAddPhoneme()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $params2 = array(
            'alphabet' => 'ipa',
            'ph' => "pɪˈkɑːn"
        );

        $response->addSpeak('You say, ',$params1)
            ->addPhoneme('pecan',$params2)
            ->continueSpeak('.')
            ->continueSpeak('I say, ')
            ->addPhoneme('pecan',array(
                'alphabet' => 'ip',
                'ph' => "ˈpi.kæn"
            ))
            ->continueSpeak('.');
        $ssml = $response->toXML(true);
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
        $response->addSpeak('You say, ',$params1)
            ->addPhoneme('pecan',$params2)
            ->continueSpeak('.')
            ->continueSpeak('I say, ')
            ->addPhoneme('pecan',array(
                'alphabet' => 'ipa',
                'ph' => "ˈpi.kæn"
            ))
            ->continueSpeak('.');
    }

}