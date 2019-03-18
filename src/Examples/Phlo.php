<?php
/**
 * Example for MultiParty Call
 */
require 'vendor/autoload.php';

use Plivo\Resources\PHLO\PhloRestClient;
use Plivo\Exceptions\PlivoRestException;


$client = new PhloRestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
$phlo = $client->phlo->get("YOUR_PHLO_ID");

$multiPartyCall = $phlo->multiPartyCall()->get("YOUR_NODE_ID");


try {
	$response = $multiPartyCall->call($trigger_source, $to, $role);
	print_r($response);
} catch (PlivoRestException $ex) {
	print_r($ex);
} 

?>

<?php
/**
 * Example for MultiParty Warm transfer
 */
require 'vendor/autoload.php';

use Plivo\Resources\PHLO\PhloRestClient;
use Plivo\Exceptions\PlivoRestException;


$client = new PhloRestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
$phlo = $client->phlo->get("YOUR_PHLO_ID");

$multiPartyCall = $phlo->multiPartyCall()->get("YOUR_NODE_ID");


try {
	$response = $multiPartyCall->warm_transfer($trigger_source, $to, $role);
	print_r($response);
} catch (PlivoRestException $ex) {
	print_r($ex);
} 

?>

<?php
/**
 * Example for MultiParty Cold transfer
 */
require 'vendor/autoload.php';

use Plivo\Resources\PHLO\PhloRestClient;
use Plivo\Exceptions\PlivoRestException;


$client = new PhloRestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
$phlo = $client->phlo->get("YOUR_PHLO_ID");

$multiPartyCall = $phlo->multiPartyCall()->get("YOUR_NODE_ID");


try {
	$response = $multiPartyCall->cold_transfer($trigger_source, $to, $role);
	print_r($response);
} catch (PlivoRestException $ex) {
	print_r($ex);
} 

?>

<?php
/**
 * Example for MultiParty Abort transfer
 */
require 'vendor/autoload.php';

use Plivo\Resources\PHLO\PhloRestClient;
use Plivo\Exceptions\PlivoRestException;


$client = new PhloRestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
$phlo = $client->phlo->get("YOUR_PHLO_ID");

$multiPartyCall = $phlo->multiPartyCall()->get("YOUR_NODE_ID");
$multiPartyCallMember = $multiPartyCall->member($memberAddress);

try {
	$response = $multiPartyCallMember->abort_transfer();
	print_r($response);
} catch (PlivoRestException $ex) {
	print_r($ex);
} 

?>

<?php
/**
 * Example for MultiParty Voicemail Drop
 */
require 'vendor/autoload.php';

use Plivo\Resources\PHLO\PhloRestClient;
use Plivo\Exceptions\PlivoRestException;


$client = new PhloRestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
$phlo = $client->phlo->get("YOUR_PHLO_ID");

$multiPartyCall = $phlo->multiPartyCall()->get("YOUR_NODE_ID");
$multiPartyCallMember = $multiPartyCall->member($memberAddress);

try {
	$response = $multiPartyCallMember->voicemail_drop();
	print_r($response);
} catch (PlivoRestException $ex) {
	print_r($ex);
} 

?>

<?php
/**
 * Example for MultiParty Hangup
 */
require 'vendor/autoload.php';

use Plivo\Resources\PHLO\PhloRestClient;
use Plivo\Exceptions\PlivoRestException;


$client = new PhloRestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
$phlo = $client->phlo->get("YOUR_PHLO_ID");

$multiPartyCall = $phlo->multiPartyCall()->get("YOUR_NODE_ID");
$multiPartyCallMember = $multiPartyCall->member($memberAddress);

try {
	$response = $multiPartyCallMember->hangup();
	print_r($response);
} catch (PlivoRestException $ex) {
	print_r($ex);
} 

?>

<?php
/**
 * Example for MultiParty Hold
 */
require 'vendor/autoload.php';

use Plivo\Resources\PHLO\PhloRestClient;
use Plivo\Exceptions\PlivoRestException;


$client = new PhloRestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
$phlo = $client->phlo->get("YOUR_PHLO_ID");

$multiPartyCall = $phlo->multiPartyCall()->get("YOUR_NODE_ID");
$multiPartyCallMember = $multiPartyCall->member($memberAddress);

try {
	$response = $multiPartyCallMember->hold();
	print_r($response);
} catch (PlivoRestException $ex) {
	print_r($ex);
} 

?>

<?php
/**
 * Example for MultiParty Unhold
 */
require 'vendor/autoload.php';

use Plivo\Resources\PHLO\PhloRestClient;
use Plivo\Exceptions\PlivoRestException;


$client = new PhloRestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
$phlo = $client->phlo->get("YOUR_PHLO_ID");

$multiPartyCall = $phlo->multiPartyCall()->get("YOUR_NODE_ID");
$multiPartyCallMember = $multiPartyCall->member($memberAddress);

try {
	$response = $multiPartyCallMember->unhold();
	print_r($response);
} catch (PlivoRestException $ex) {
	print_r($ex);
} 

?>

<?php
/**
 * Example for MultiParty Resume
 */
require 'vendor/autoload.php';

use Plivo\Resources\PHLO\PhloRestClient;
use Plivo\Exceptions\PlivoRestException;

use Plivo\Resources\PHLO\PhloRestClient;
use Plivo\Exceptions\PlivoRestException;


$client = new PhloRestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
$phlo = $client->phlo->get("YOUR_PHLO_ID");

$multiPartyCall = $phlo->multiPartyCall()->get("YOUR_NODE_ID");
$multiPartyCallMember = $multiPartyCall->member($memberAddress);

try {
	$response = $multiPartyCallMember->unhold();
	print_r($response);
} catch (PlivoRestException $ex) {
	print_r($ex);
} 

?>

<?php
/**
 * Example for MultiParty Resume
 */
require 'vendor/autoload.php';

use Plivo\Resources\PHLO\PhloRestClient;
use Plivo\Exceptions\PlivoRestException;


$client = new PhloRestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
$phlo = $client->phlo->get("YOUR_PHLO_ID");

$multiPartyCall = $phlo->multiPartyCall()->get("YOUR_NODE_ID");
$multiPartyCallMember = $multiPartyCall->member($memberAddress);

try {
	$response = $multiPartyCallMember->resume_call();
	print_r($response);
} catch (PlivoRestException $ex) {
	print_r($ex);
} 

?>


<?php
/**
 * Example for API Request
 */
require 'vendor/autoload.php';

use Plivo\Resources\PHLO\PhloRestClient;
use Plivo\Exceptions\PlivoRestException;


$client = new PhloRestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
$phlo = $client->phlo->get("YOUR_PHLO_ID");

try {
	$response = $phlo->run(["field1" => "value1", "field2" => "value2"]); // These are the fields entered in the PHLO console
	print_r($response);
} catch (PlivoRestException $ex) {
	print_r($ex);
} 

?>

<?php
/**
 * Example for PHLO Getter
 */
require 'vendor/autoload.php';

use Plivo\Resources\PHLO\PhloRestClient;
use Plivo\Exceptions\PlivoRestException;


$client = new PhloRestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
$phlo = $client->phlo->getPhlo("YOUR_PHLO_ID");
print_r($response);

?>


