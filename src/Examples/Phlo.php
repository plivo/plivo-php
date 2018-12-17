<?php

namespace Plivo;

// First we need to initialise the Client with the AUTH_ID and AUTH_TOKEN for your plivo account
$client = new PhloRestClient(AUTH_ID, AUTH_TOKEN);

// Now we can initialise PHLO with the PHLO_ID for your account
$phlo = $client->phlo->get(PHLO_ID);

// MULTI PATY CALL API's

// You will have to initialise your Multi Party call with NODE_ID for the Multi Party PHLO
$multiPartyCall = $phlo->multiPartyCall()->get(NODE_ID);

// Then we can use this $multiPartyCall to implement various features of Multi Party Call

// 1. Node API'S

// call API
$multiPartyCall->call($trigger_source, $to, $role);

// or we can chain the method directly while retreiving the multi_party_call like shown below
$phlo->multiPartyCall()->get(NODE_ID)->call($trigger_source, $to, $role);

// This same procedure can be used for warm_transfer and cold_transfer like shown below
$phlo->multiPartyCall()->get(NODE_ID)->warm_transfer($trigger_source, $to, $role);
$phlo->multiPartyCall()->get(NODE_ID)->cold_transfer($trigger_source, $to, $role);


// 2. Node member API'S

// Here after you get the $multiPartyCall object you need to fetch the member object from it like below
$multiPartyCallMember = $phlo->multiPartyCall()->get(NODE_ID)->member($memberAddress);

// abort_transfer
$multiPartyCallMember->abort_transfer();

// or like as shown above we can chain this directly to where retreiving the member like shown below
$phlo->multiPartyCall()->get(NODE_ID)->member($memberAddress)->abort_transfer();

// Similarly we can have api's for voicemail_drop, hangup, hold, unhold, resume, etc
$phlo->multiPartyCall()->get(NODE_ID)->member($memberAddress)->voicemail_drop();
$phlo->multiPartyCall()->get(NODE_ID)->member($memberAddress)->hangup();
$phlo->multiPartyCall()->get(NODE_ID)->member($memberAddress)->hold();
$phlo->multiPartyCall()->get(NODE_ID)->member($memberAddress)->unhold();
$phlo->multiPartyCall()->get(NODE_ID)->member($memberAddress)->resume();



// Conference Bridge API's

// Just like we did for MultiPartyCall we need to follow the same procedure for creating a Conference Bridge
$conferenceBridge = $phlo->conferenceBridge()->get(NODE_ID)->member($memberAddress);

// and then we can call functions like mute, unmute etc on this object either directly while retrieving or to the object
// returned after fetching Conference Bridge similar to what we did for Multi Party Call
$conferenceBridge->mute()

// or
$phlo->conferenceBridge()->get(NODE_ID)->member($memberAddress)->mute();



// HTTP Requests

// In this you have a PHLO with pre-defined set of arguments and you can run a PHLO with those arguments

// first we get the PHLO like shown at the top
$phlo = $client->phlo->get(PHLO_ID);

// and then run the PHLO either on this $phlo object or chain it to the above call where we are fetching the
// PHLO object like below

$phlo->run(["field1" => "value1", "field2" => "value2"]);

// or

$client->phlo->get(PHLO_ID)->run(["field1" => "value1", "field2" => "value2"]);