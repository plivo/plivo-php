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
        "1252fa3a-d5f9-4e49-b42b-fb2d5557dfee"
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
        "EndUserName", "Business", "EndUserLastName"
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
        "d2f4905f-9c8b-499f-ab10-82f261f796bd"
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
        ["authorized_representative_name" => "lsumpsum", "path" => "file path"]
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
        'end_user_id' => '652e1445-1657-4a80-972f-6dbd467b00b5',
        'path' => 'file path'
    );
    $response = $client->complianceDocument->update(
        'd2f4905f-9c8b-499f-ab10-82f261f796bd',
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

// List ComplianceRequirement
echo "########## List ComplianceRequirement ###################\n";
try {
    $params = array(
        'country_iso2' => 'FR',
        'number_type' => 'mobile',
        'end_user_type' => 'business'
    );
    $response = $client->complianceRequirement->list(
        $params
    );

    print_r($response->properties);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// Get ComplianceRequirement by complianceRequirementId
echo "########## Get ComplianceRequirement ###################\n";
try {
    $response = $client->complianceRequirement->get(
        "28701b64-46b7-42b0-a620-98fec19e4db1"
    );

    print_r($response->properties);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// List ComplianceApplication
echo "########## List ComplianceApplication ###################\n";
try {
    $params = array(
        'limit' => 1
    );
    $response = $client->complianceApplication->list(
        $params
    );

    print_r($response->resources[0]->properties);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// Get ComplianceApplication by complianceApplicationId
echo "########## Get ComplianceApplication ###################\n";
try {
    $response = $client->complianceApplication->get(
        "65882418-e1f2-40dd-94b6-f490ee9eef22"
    );

    print_r($response->properties);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// Delete ComplianceApplication by complianceApplicationId
echo "########## Delete ComplianceApplication ###################\n";
try {
    $response = $client->complianceApplication->delete(
        "65882418-e1f2-40dd-94b6-f490ee9eef22"
    );

    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// Create ComplianceApplication by complianceApplicationId
echo "########## Create ComplianceApplication ###################\n";
try {
    $response = $client->complianceApplication->create(
        "app_php_18",
        "dda8585a-2c90-4286-b1df-b9e472bcef36",
        ["535d8bfe-f76c-485c-b34c-225cb39ad773"],
        null,
        ['country_iso2' => 'BE', 'number_type' => 'mobile', 'end_user_type' => 'individual']
    );

    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// Update ComplianceApplication by complianceApplicationId
echo "########## Update ComplianceApplication ###################\n";
try {
    $response = $client->complianceApplication->update(
        "3d10e180-abba-443d-85fd-f27d834ee7ed",
        ["535d8bfe-f76c-485c-b34c-225cb39ad773"]
    );

    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}

// Submit ComplianceApplication by complianceApplicationId
echo "########## Submit ComplianceApplication ###################\n";
try {
    $response = $client->complianceApplication->submit(
        "65882418-e1f2-40dd-94b6-f490ee9eef22"
    );

    print_r($response);
}
catch (PlivoRestException $ex) {
    print_r($ex);
}
