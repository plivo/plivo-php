<?php


require 'vendor/autoload.php';

use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;


$AUTH_ID = "AUTH_ID";
$AUTH_TOKEN = "AUTH_TOKEN";

$client = new RestClient($AUTH_ID, $AUTH_TOKEN);
$client->client->setTimeout(40);

// Create LOA
echo "########## CREATE LOA ###################\n";
try {
    $file = 'file_path';
    $alias = 'alias';
    $response = $client->hostedMessageLOA->create($alias, $file);
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}

// List LOA
echo "########## List LOA ###################\n";
try {
    $params = array(
        'limit' => 10,
        'offset' => 0,
        'alias' => "alias"
    );
    $response = $client->hostedMessageLOA->list($params);
    foreach ($response->resources as $res) {
        print_r($res->properties);    
    }
} catch (PlivoRestException $ex) {
    print_r($ex);
}


// Get LOA by loaID
echo "########## Get LOA ###################\n";
try {
    $response = $client->hostedMessageLOA->get(
      "loaId"
    );

    print_r($response->properties);
} catch (PlivoRestException $ex) {
    print_r($ex);
}


// DELETE LOA by loaID
echo "########## DELETE LOA ###################\n";
try {
    $client->hostedMessageLOA->delete(
        "hostedMessageLOAId"
    );
   
} catch (PlivoRestException $ex) {
    print_r($ex);
}

// List HostedMessagingNumber
echo "########## List HostedMessagingNumber ###################\n";
try {
    $params = array(
        'limit' => 1,
        'offset' => 0,
        'hosted_status' => 'disconnected',
        'number' => 'number',
        'loa_id' => 'loa_id',
        'alias' => 'alias'
    );
    $response = $client->hostedMessagingNumber->list($params);
    foreach ($response->resources as $res) {
        print_r($res->properties);    
    }
} catch (PlivoRestException $ex) {
    print_r($ex);
}


// Create HostedMessagingNumber
echo "########## CREATE HostedMessagingNumber ###################\n";
try {
   
    $alias = 'alias';
    $appId = "appid";
    $loaId = "loaID";
    $number = "number";
    $response = $client->hostedMessagingNumber->create($alias, $loaId,$appId,$number);
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}


// Get HostedMessagingNumber by hostedMessagingNumberID
echo "########## Get HostedMessagingNumber ###################\n";
try {
    $response = $client->hostedMessagingNumber->get(
        "hostedMessagingOrderID"
    );
    print_r($response->properties);
} catch (PlivoRestException $ex) {
    print_r($ex);
}
