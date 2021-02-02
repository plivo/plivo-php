<?php


require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;



$AUTH_ID = "YOUR_AUTH_ID";
$AUTH_TOKEN = "YOUR_AUTH_TOKEN";

$client = new RestClient($AUTH_ID, $AUTH_TOKEN);
$client->client->setTimeout(40);

// List EndUsers
echo "########## List EndUser ###################\n";
try {
    $params = array(
        'limit' => 1
    );
    $response = $client->endUsers->list(
        $params
    );

    print_r($response->resources[0]->properties);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// Get EndUser by endUserID
echo "########## Get EndUser ###################\n";
try {
    $response = $client->endUsers->get(
        "652e1445-1657-4a80-972f-6dbd467b00b5"
    );

    print_r($response->properties);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// Update EndUser by endUserID
echo "########## Update EndUser ###################\n";
try {
    $params = array(
        'name' => "EndUserName",
        'last_name' => "EndUserLastName",
        'end_user_type' => "Business"
    );

    $response = $client->endUsers->update(
        "721b29c4-4291-4922-8743-94d84843945c",
        $params
    );

    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// Delete EndUser by endUserId
echo "########## Delete EndUser ###################\n";
try {
    $response = $client->endUsers->delete(
        "721b29c4-4291-4922-8743-94d84843945c"
    );

    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// Create EndUser by endUserId
echo "########## Create EndUser ###################\n";
try {
    $response = $client->endUsers->create(
        "EndUserName", "Business", "EndUserLastName",
    );
    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}