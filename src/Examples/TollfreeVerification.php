<?php


require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;



$AUTH_ID = "MAYJLIZGQ5MWVKZWM4NZ";
$AUTH_TOKEN = "MjFkZjQ3MzhiODFlZmY4MjIyODk2NTgxOGVmMD";

$client = new RestClient($AUTH_ID, $AUTH_TOKEN);
$client->client->setTimeout(40);


// Get TollfreeVerification by uuid
echo "########## Get TollfreeVerification ###################\n";
try {
    $response = $client->complianceApplication->get(
        "7f4deae2-5d79-46ec-5088-218504abf664"
    );

    print_r($response->properties);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}