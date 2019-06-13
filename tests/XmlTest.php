<?php

namespace Plivo\Tests;

use Plivo\XML\Response;


/**
 * Class AccountTest
 * @package Plivo\Tests\Resources
 */
class XmlTest extends BaseTestCase
{
    /**
     *
     */
    function testXml()
    {
        $resp = new Response();
        $resp->addConference("My room",
                ['callbackUrl' => "http://foo.com/confevents/",
                'callbackMethod' => "POST",
                'digitsMatch' => "#0,99,000"]);

        $dial = $resp->addDial(
            [
                'confirmSound' => "http://foo.com/sound/",
                'confirmKey' => "3"
            ]);
        $dial->addNumber("18217654321",
            [
                'sendDigits' => "wwww2410"
            ]);
        $dial->addUser("sip:john1234@phone.plivo.com",
            [
                'sendDigits' => "wwww2410"
            ]);

        $dial1 = $resp->addDial(
            [
                'timeout' => "20",
                'action' => "http://oo.com/dial_action/"
            ]);

        $dial1->addNumber("18217654321", []);

        $dial2 = $resp->addDial([]);
        $dial2->addNumber("15671234567", []);

        $resp->addDTMF("12345", []);

        $get_digits = $resp->addGetDigits(
            [
                'action' => "http://www.foo.com/gather_pin/",
                "method" => "POST"
            ]);

        $get_digits->addSpeak("Enter PIN number.", []);
        $resp->addSpeak("Input not recieved.", []);

        $resp->addHangup(
            [
                'schedule' => "60",
                'reason' => "rejected"
            ]);
        $resp->addSpeak("Call will hangup after a min.",
            [
                'loop' => "0"
            ]);

        $resp->addMessage("Hi, message from Plivo.",
            [
                'src' => "12023222222",
                'dst' => "15671234567"  ,
                'type' => "sms",
                'callbackUrl' => "http://foo.com/sms_status/",
                'callbackMethod' => "POST"
            ]);

        $resp->addPlay("https://amazonaws.com/Trumpet.mp3", []);

        $answer = $resp->addPreAnswer();
        $answer->addSpeak("This call will cost $2 a min.", []);
        $resp->addSpeak("Thanks for dropping by.", []);

        $resp->addRecord(
            [
                'action' => "http://foo.com/get_recording/",
                'startOnDialAnswer' => "true",
                'redirect' => "false"
            ]);

        $dial3 = $resp->addDial([]);

        $dial3->addNumber("15551234567", []);

        $resp->addSpeak("Leave message after the beep.", []);
        $resp->addRecord(
            [
                'action' => "http://foo.com/get_recording/",
                'maxLength' => "30",
                'finishOnKey' => "*"
            ]);
        $resp->addSpeak("Recording not received.", []);

        $resp->addSpeak("Your call is being transferred.", []);
        $resp->addRedirect("http://foo.com/redirect/", []);

        $resp->addSpeak("Go green, go plivo.",
            [
                'loop' => "3"
            ]);

        $resp->addSpeak("I will wait 7 seconds starting now!", []);
        $resp->addWait(
            [
                'length' => "7"
            ]);
        $resp->addSpeak("I just waited 7 seconds.", []);

        $resp->addWait(
            [
                'length' => "120", 'beep' => "true"
            ]);
        $resp->addPlay("https://s3.amazonaws.com/abc.mp3", []);

        $resp->addWait(
            [
                'length' => "10"
            ]);
        $resp->addSpeak("Hello", []);

        $resp->addWait(
            [
                'length' => "10",
                'silence' => "true",
                'minSilence' => "3000"
            ]);
        $resp->addSpeak("Hello, welcome to the Jungle.", []);

        $output = $resp->toXML(true);
        self::assertEquals(
            "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<Response><Conference callbackUrl=\"http://foo.com/confevents/\" callbackMethod=\"POST\" digitsMatch=\"#0,99,000\">My room</Conference><Dial confirmSound=\"http://foo.com/sound/\" confirmKey=\"3\"><Number sendDigits=\"wwww2410\">18217654321</Number><User sendDigits=\"wwww2410\">sip:john1234@phone.plivo.com</User></Dial><Dial timeout=\"20\" action=\"http://oo.com/dial_action/\"><Number>18217654321</Number></Dial><Dial><Number>15671234567</Number></Dial><DTMF>12345</DTMF><GetDigits action=\"http://www.foo.com/gather_pin/\" method=\"POST\"><Speak>Enter PIN number.</Speak></GetDigits><Speak>Input not recieved.</Speak><Hangup schedule=\"60\" reason=\"rejected\"/><Speak loop=\"0\">Call will hangup after a min.</Speak><Message src=\"12023222222\" dst=\"15671234567\" type=\"sms\" callbackUrl=\"http://foo.com/sms_status/\" callbackMethod=\"POST\">Hi, message from Plivo.</Message><Play>https://amazonaws.com/Trumpet.mp3</Play><PreAnswer><Speak>This call will cost $2 a min.</Speak></PreAnswer><Speak>Thanks for dropping by.</Speak><Record action=\"http://foo.com/get_recording/\" startOnDialAnswer=\"true\" redirect=\"false\"/><Dial><Number>15551234567</Number></Dial><Speak>Leave message after the beep.</Speak><Record action=\"http://foo.com/get_recording/\" maxLength=\"30\" finishOnKey=\"*\"/><Speak>Recording not received.</Speak><Speak>Your call is being transferred.</Speak><Redirect>http://foo.com/redirect/</Redirect><Speak loop=\"3\">Go green, go plivo.</Speak><Speak>I will wait 7 seconds starting now!</Speak><Wait length=\"7\"/><Speak>I just waited 7 seconds.</Speak><Wait length=\"120\" beep=\"true\"/><Play>https://s3.amazonaws.com/abc.mp3</Play><Wait length=\"10\"/><Speak>Hello</Speak><Wait length=\"10\" silence=\"true\" minSilence=\"3000\"/><Speak>Hello, welcome to the Jungle.</Speak></Response>\n",
            $output);
    }
}
