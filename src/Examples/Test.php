<?php
/**
 * Example for PHLO Getter
 */
require 'vendor/autoload.php';

use Plivo\Resources\PHLO\PhloRestClient;
use Plivo\Exceptions\PlivoRestException;

$auth_id = "MAYJFHYTA2NMYZYTU2NT";
$auth_token = "OWVmZTk2YTUzMzI0NWEyMDI0MjE4OWU1ZGU5MzQ3";

$client = new PhloRestClient($auth_id, $auth_token);
// $phlo = $client->phlo->getPhlo("9273831e-7c73-47c2-a003-b7ef2408760f");
// print_r($phlo);
$phlo = $client->phlo->get("9273831e-7c73-47c2-a003-b7ef2408760f");
try {
	$response = $phlo->run(["field1" => "value1", "field2" => "value2"]); // These are the fields entered in the PHLO console
	print_r($response);
} catch (PlivoRestException $ex) {
	print_r($ex);
} 

?>