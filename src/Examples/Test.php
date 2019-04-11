<?php
    require 'vendor/autoload.php';

    use Plivo\RestClient;

    use Plivo\Exceptions\PlivoRestException;
    use Plivo\Exceptions\PlivoResponseException;

    $client = new RestClient("MAMTK2MGFHNTVINWQYZT", "N2FmNzdhMTc2ZmY5MWEyNzhhMDk1YWEwODM4NzIx");

    try {

    $response = $client->messages->create(

    '14849386095',

    ['19512920069'],

    'hello, test message!');

    print_r($response->getMessageUuid());

    }

    catch (PlivoResponseException $ex) {

        // print_r($ex);

        // print_r($ex->getErrorMessage());

    }