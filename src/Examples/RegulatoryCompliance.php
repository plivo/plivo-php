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
    $response = $client->endUser->list(
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
    $response = $client->endUser->get(
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

    $response = $client->endUser->update(
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
    $response = $client->endUser->delete(
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
    $response = $client->endUser->create(
        "EndUserName", "Business", "EndUserLastName",
    );
    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// List ComplianceDocumentType
echo "########## List ComplianceDocumentType ###################\n";
try {
    $params = array(
        'limit' => 1
    );
    $response = $client->complianceDocumentType->list(
        $params
    );

    print_r($response->resources[0]->properties);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// Get ComplianceDocumentType by complianceDocumentTypeId
echo "########## Get ComplianceDocumentType ###################\n";
try {
    $response = $client->complianceDocumentType->get(
        "6264e9ee-5826-4f9a-80ce-00b00f7a6c0c"
    );

    print_r($response->properties);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// List ComplianceDocument
echo "########## List ComplianceDocument ###################\n";
try {
    $params = array(
        'limit' => 1
    );
    $response = $client->complianceDocument->list(
        $params
    );

    print_r($response->resources[0]->properties);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// Get ComplianceDocument by complianceDocumentId
echo "########## Get ComplianceDocument ###################\n";
try {
    $response = $client->complianceDocument->get(
        "f9aacb6f-9e05-40e7-baad-a126921b72bc"
    );

    print_r($response->properties);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// Create ComplianceDocument by complianceDocumentId
echo "########## Create ComplianceDocument ###################\n";
try {
    $response = $client->complianceDocument->create(
        "alias",
        "652e1445-1657-4a80-972f-6dbd467b00b5",
        "900b6f44-b0e8-4c48-a58b-5be7ef58396a",
        "filePath",
        ["authorized_representative_name" => "lsumpsum"]
    );

    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// Update ComplianceDocument by complianceDocumentId
echo "########## Update ComplianceDocument ###################\n";
try {
    $params = array(
        'alias' => 'alias',
        'end_user_id' => '652e1445-1657-4a80-972f-6dbd467b00b5'
    );
    $response = $client->complianceDocument->update(
        '6e661510-31cd-4d09-84ab-e739939df85e',
        $params
    );

    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// Delete ComplianceDocument by complianceDocumentId
echo "########## Delete ComplianceDocument ###################\n";
try {
    $response = $client->complianceDocument->delete(
        "f9aacb6f-9e05-40e7-baad-a126921b72bc"
    );

    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}