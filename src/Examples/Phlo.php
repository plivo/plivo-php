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
	$multiPartyCall->call($trigger_source, $to, $role);
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
	$multiPartyCall->warm_transfer($trigger_source, $to, $role);
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
	$multiPartyCall->cold_transfer($trigger_source, $to, $role);
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
	$multiPartyCallMember->abort_transfer();
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
	$multiPartyCallMember->voicemail_drop();
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
	$multiPartyCallMember->hangup();
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
	$multiPartyCallMember->hold();
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
	$multiPartyCallMember->unhold();
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
	$multiPartyCallMember->resume();
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
	$phlo->run(["field1" => "value1", "field2" => "value2"]); // These are the fields entered in the PHLO console
} catch (PlivoRestException $ex) {
	print_r($ex);
} 

?>


