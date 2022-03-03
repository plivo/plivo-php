<?php
/**
 * Example for Call create
 */
require 'vendor/autoload.php';
use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;
$client = new RestClient("","");
try {
    $response = $client->calls->create(
        '+14151234567',
        ['sip:ajaydjv902035012689385@phone-qa.voice.plivodev.com'],
        'https://s3.amazonaws.com/static.plivo.com/answer.xml',
        'GET'
    );
    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}