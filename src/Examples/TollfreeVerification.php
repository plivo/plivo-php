<?php


require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;



$AUTH_ID = "authid";
$AUTH_TOKEN = "authtoken";

$client = new RestClient($AUTH_ID, $AUTH_TOKEN);
$client->client->setTimeout(40);


// Get TollfreeVerification by uuid
echo "########## Get TollfreeVerification ###################\n";
try {
    $response = $client->tollfreeVerification->get(
        "03420d77-4fa8-45e1-6aad-f37d41a2ee4a"
    );

    print_r($response->properties);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}


// List TollfreeVerification
echo "########## List TollfreeVerification ###################\n";
try {
    $response = $client->tollfreeVerification->getList();

    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// // Create TollfreeVerification
// echo "########## Create TollfreeVerification ###################\n";
// try {
//     $response = $client->tollfreeVerification->create(
//     "18554950186",
//          "2FA",
//     "42f92135-6ec2-4110-8da4-71171f6aad44",
//     "VERBAL",
//      "100",
//     "hbv",
//      "message_sample",
//      "http://google.com",
//     "https://plivobin-prod-usw1.plivops.com/1pcfjrt1",
//      "POST",
//      "this is additional_information",
//     "this is extra_data"
//     );
//
//     print_r($response);
// }
// catch (PlivoRestException $ex) {
//     print_r($ex);
// }
//
//
// // // Update TollfreeVerification by TollfreeVerification
// // echo "########## Update TollfreeVerification ###################\n";
// // try {
// //     $response = $client->tollfreeVerification->update(
// //         "81fc8b2d-1ab8-47c9-7245-e454227b7b7b",
// //         ["3FA"]
// //     );
// //
// //     print_r($response);
// // }
// // catch (PlivoRestException $ex) {
// //     print_r($ex);
// // }
//
