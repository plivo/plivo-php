<?php


require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;



$AUTH_ID = "YOUR_AUTH_ID";
$AUTH_TOKEN = "YOUR_AUTH_TOKEN";

$client = new RestClient($AUTH_ID, $AUTH_TOKEN);
$client->client->setTimeout(40);

try {
    $params = array(
        'limit' => 1
    );
    $response = $client->phonenumbers->list(
        'US', $params
    );

    print_r($response);
//     print_r($response->resources[0]->properties);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}
