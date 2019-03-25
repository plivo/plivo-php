<?php
require 'vendor/autoload.php';
use Plivo\XML\Response;

$response = new Response();
$params1 = array(
    'language' => 'en-US', # Language used to read out the text.
    'voice' => 'Polly.Joanna', # The tone to be used for reading out the text.  
);
$params2 = array(
    'strength' => 'medium', # Language used to read out the text.
    'time' => '2s', # The tone to be used for reading out the text.  
);
$response->addSpeak('Hello, Rex! Your birthday is on ',$params1);
$response->addBreak();
$response->addProsody('really like ',array('pitch'=>'-1%'));
// $response->addEmphasis('really like ',array('level'=>'strong'));
// $response->addLang('plivo mein aapaka svaagat hai',array('xmllang'=>'hi-IN'));
// $response->addP('I already told you I ');
// $response->addPhoneme('really like ',array('alphabet'=>'ipa','ph'=>'pɪˈkɑːn'));
echo $response;