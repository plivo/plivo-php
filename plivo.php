<?php

namespace Plivo;

use GuzzleHttp\Client;

class PlivoError extends \Exception {}

class RestAPI {
    private $api;

    private $auth_id;

    private $auth_token;

    function __construct($auth_id, $auth_token, $url = "https://api.plivo.com", $version = "v1") {
        if ((!isset($auth_id)) || (!$auth_id)) {
            throw new PlivoError("no auth_id");
        }
        if ((!isset($auth_token)) || (!$auth_token)) {
            throw new PlivoError("no auth_token");
        }
        $this->version = $version;
        $this->api = $url."/".$this->version."/Account/".$auth_id;
        $this->auth_id = $auth_id;
        $this->auth_token = $auth_token;
    }

    public static function validate_signature($uri, $post_params=array(), $signature, $auth_token) {
        ksort($post_params);
        foreach($post_params as $key => $value) {
            $uri .= "$key$value";
        }
        $generated_signature = base64_encode(hash_hmac("sha1",$uri, $auth_token, true));
        return $generated_signature == $signature;
    }

    private function request($method, $path, $params = array()) {
        $url = $this->api.rtrim($path, '/').'/';

        $client = new Client([
            'base_uri' => $url,
            'auth' => [$this->auth_id, $this->auth_token],
            'http_errors' => false
        ]);

        if (!strcmp($method, "POST")) {
            $body = json_encode($params, JSON_FORCE_OBJECT);

            $response = $client->post('', array(
                'headers' => [ 'Content-type' => 'application/json'],
                'body'    => $body,
            ));
        } else if (!strcmp($method, "GET")) {
            $response = $client->get('', array(
                'query' => $params,
            ));
        } else if (!strcmp($method, "DELETE")) {
            $response = $client->delete('', array(
                'query' => $params,
            ));
        }
        $responseData = json_decode($response->getBody(), true);
        $status = $response->getStatusCode();

        return array("status" => $status, "response" => $responseData);
    }

    private function pop($params, $key) {
        $val = $params[ $key ];
        if (!$val) {
            throw new PlivoError($key." parameter not found");
        }
        unset($params[ $key ]);

        return $val;
    }

    ## Accounts ##
    public function get_account($params = array()) {
        return $this->request('GET', '', $params);
    }

    public function modify_account($params = array()) {
        return $this->request('POST', '', $params);
    }

    public function get_subaccounts($params = array()) {
        return $this->request('GET', '/Subaccount/', $params);
    }

    public function create_subaccount($params = array()) {
        return $this->request('POST', '/Subaccount/', $params);
    }

    public function get_subaccount($params = array()) {
        $subauth_id = $this->pop($params, "subauth_id");

        return $this->request('GET', '/Subaccount/'.$subauth_id.'/', $params);
    }

    public function modify_subaccount($params = array()) {
        $subauth_id = $this->pop($params, "subauth_id");

        return $this->request('POST', '/Subaccount/'.$subauth_id.'/', $params);
    }

    public function delete_subaccount($params = array()) {
        $subauth_id = $this->pop($params, "subauth_id");

        return $this->request('DELETE', '/Subaccount/'.$subauth_id.'/', $params);
    }

    ## Applications ##
    public function get_applications($params = array()) {
        return $this->request('GET', '/Application/', $params);
    }

    public function create_application($params = array()) {
        return $this->request('POST', '/Application/', $params);
    }

    public function get_application($params = array()) {
        $app_id = $this->pop($params, "app_id");

        return $this->request('GET', '/Application/'.$app_id.'/', $params);
    }

    public function modify_application($params = array()) {
        $app_id = $this->pop($params, "app_id");

        return $this->request('POST', '/Application/'.$app_id.'/', $params);
    }

    public function delete_application($params = array()) {
        $app_id = $this->pop($params, "app_id");

        return $this->request('DELETE', '/Application/'.$app_id.'/', $params);
    }

    ## Numbers ##
    public function get_numbers($params = array()) {
        return $this->request('GET', '/Number/', $params);
    }

    ## This API is available only for US numbers with some limitations ##
    ## Please use get_number_group and rent_from_number_group instead ##
    public function search_numbers($params = array()) {
        return $this->request('GET', '/AvailableNumber/', $params);
    }

    public function get_number($params = array()) {
        $number = $this->pop($params, "number");

        return $this->request('GET', '/Number/'.$number.'/', $params);
    }

    public function modify_number($params = array()) {
        $number = $this->pop($params, "number");

        return $this->request('POST', '/Number/'.$number.'/', $params);
    }

    ## This API is available only for US numbers with some limitations ##
    ## Please use get_number_group and rent_from_number_group instead ##
    public function rent_number($params = array()) {
        $number = $this->pop($params, "number");

        return $this->request('POST', '/AvailableNumber/'.$number.'/');
    }

    public function unrent_number($params = array()) {
        $number = $this->pop($params, "number");

        return $this->request('DELETE', '/Number/'.$number.'/', $params);
    }

    ## Phone Numbers ##
    public function search_phone_numbers($params = array()) {
        return $this->request('GET', '/PhoneNumber/', $params);
    }

    public function buy_phone_number($params = array()) {
        $number = $this->pop($params, "number");

        return $this->request('POST', '/PhoneNumber/'.$number.'/');
    }

    public function link_application_number($params = array()) {
        $number = $this->pop($params, "number");

        return $this->request('POST', '/Number/'.$number.'/', $params);
    }

    public function unlink_application_number($params = array()) {
        $number = $this->pop($params, "number");
        $params = array("app_id" => "");

        return $this->request('POST', '/Number/'.$number.'/', $params);
    }

    public function get_number_group($params = array()) {
        return $this->request('GET', '/AvailableNumberGroup/', $params);
    }

    public function get_number_group_details($params = array()) {
        $group_id = $this->pop($params, "group_id");

        return $this->request('GET', '/AvailableNumberGroup/'.$group_id.'/', $params);
    }

    public function rent_from_number_group($params = array()) {
        $group_id = $this->pop($params, "group_id");

        return $this->request('POST', '/AvailableNumberGroup/'.$group_id.'/', $params);
    }

    ## Calls ##
    public function get_cdrs($params = array()) {
        return $this->request('GET', '/Call/', $params);
    }

    public function get_cdr($params = array()) {
        $record_id = $this->pop($params, 'record_id');

        return $this->request('GET', '/Call/'.$record_id.'/', $params);
    }

    public function get_live_calls($params = array()) {
        $params["status"] = "live";

        return $this->request('GET', '/Call/', $params);
    }

    public function get_live_call($params = array()) {
        $call_uuid = $this->pop($params, 'call_uuid');
        $params["status"] = "live";

        return $this->request('GET', '/Call/'.$call_uuid.'/', $params);
    }

    public function make_call($params = array()) {
        return $this->request('POST', '/Call/', $params);
    }

    public function hangup_all_calls($params = array()) {
        return $this->request('DELETE', '/Call/', $params);
    }

    public function transfer_call($params = array()) {
        $call_uuid = $this->pop($params, 'call_uuid');

        return $this->request('POST', '/Call/'.$call_uuid.'/', $params);
    }

    public function hangup_call($params = array()) {
        $call_uuid = $this->pop($params, 'call_uuid');

        return $this->request('DELETE', '/Call/'.$call_uuid.'/', $params);
    }

    public function record($params = array()) {
        $call_uuid = $this->pop($params, 'call_uuid');

        return $this->request('POST', '/Call/'.$call_uuid.'/Record/', $params);
    }

    public function stop_record($params = array()) {
        $call_uuid = $this->pop($params, 'call_uuid');

        return $this->request('DELETE', '/Call/'.$call_uuid.'/Record/', $params);
    }

    public function play($params = array()) {
        $call_uuid = $this->pop($params, 'call_uuid');

        return $this->request('POST', '/Call/'.$call_uuid.'/Play/', $params);
    }

    public function stop_play($params = array()) {
        $call_uuid = $this->pop($params, 'call_uuid');

        return $this->request('DELETE', '/Call/'.$call_uuid.'/Play/', $params);
    }

    public function speak($params = array()) {
        $call_uuid = $this->pop($params, 'call_uuid');

        return $this->request('POST', '/Call/'.$call_uuid.'/Speak/', $params);
    }

    public function stop_speak($params = array()) {
        $call_uuid = $this->pop($params, 'call_uuid');

        return $this->request('DELETE', '/Call/'.$call_uuid.'/Speak/', $params);
    }

    public function send_digits($params = array()) {
        $call_uuid = $this->pop($params, 'call_uuid');

        return $this->request('POST', '/Call/'.$call_uuid.'/DTMF/', $params);
    }

    ## Calls requests ##
    public function hangup_request($params = array()) {
        $request_uuid = $this->pop($params, 'request_uuid');

        return $this->request('DELETE', '/Request/'.$request_uuid.'/', $params);
    }

    ## Conferences ##
    public function get_live_conferences($params = array()) {
        return $this->request('GET', '/Conference/', $params);
    }

    public function hangup_all_conferences($params = array()) {
        return $this->request('DELETE', '/Conference/', $params);
    }

    public function get_live_conference($params = array()) {
        $conference_name = $this->pop($params, 'conference_name');
        $conference_name = rawurlencode($conference_name);

        return $this->request('GET', '/Conference/'.$conference_name.'/', $params);
    }

    public function hangup_conference($params = array()) {
        $conference_name = $this->pop($params, 'conference_name');
        $conference_name = rawurlencode($conference_name);

        return $this->request('DELETE', '/Conference/'.$conference_name.'/', $params);
    }

    public function hangup_member($params = array()) {
        $conference_name = $this->pop($params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop($params, 'member_id');

        return $this->request('DELETE', '/Conference/'.$conference_name.'/Member/'.$member_id.'/', $params);
    }

    public function play_member($params = array()) {
        $conference_name = $this->pop($params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop($params, 'member_id');

        return $this->request('POST', '/Conference/'.$conference_name.'/Member/'.$member_id.'/Play/', $params);
    }

    public function stop_play_member($params = array()) {
        $conference_name = $this->pop($params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop($params, 'member_id');

        return $this->request('DELETE', '/Conference/'.$conference_name.'/Member/'.$member_id.'/Play/', $params);
    }

    public function speak_member($params = array()) {
        $conference_name = $this->pop($params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop($params, 'member_id');

        return $this->request('POST', '/Conference/'.$conference_name.'/Member/'.$member_id.'/Speak/', $params);
    }

    public function deaf_member($params = array()) {
        $conference_name = $this->pop($params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop($params, 'member_id');

        return $this->request('POST', '/Conference/'.$conference_name.'/Member/'.$member_id.'/Deaf/', $params);
    }

    public function undeaf_member($params = array()) {
        $conference_name = $this->pop($params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop($params, 'member_id');

        return $this->request('DELETE', '/Conference/'.$conference_name.'/Member/'.$member_id.'/Deaf/', $params);
    }

    public function mute_member($params = array()) {
        $conference_name = $this->pop($params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop($params, 'member_id');

        return $this->request('POST', '/Conference/'.$conference_name.'/Member/'.$member_id.'/Mute/', $params);
    }

    public function unmute_member($params = array()) {
        $conference_name = $this->pop($params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop($params, 'member_id');

        return $this->request('DELETE', '/Conference/'.$conference_name.'/Member/'.$member_id.'/Mute/', $params);
    }

    public function kick_member($params = array()) {
        $conference_name = $this->pop($params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop($params, 'member_id');

        return $this->request('POST', '/Conference/'.$conference_name.'/Member/'.$member_id.'/Kick/', $params);
    }

    public function record_conference($params = array()) {
        $conference_name = $this->pop($params, 'conference_name');
        $conference_name = rawurlencode($conference_name);

        return $this->request('POST', '/Conference/'.$conference_name.'/Record/', $params);
    }

    public function stop_record_conference($params = array()) {
        $conference_name = $this->pop($params, 'conference_name');
        $conference_name = rawurlencode($conference_name);

        return $this->request('DELETE', '/Conference/'.$conference_name.'/Record/', $params);
    }

    ## Recordings ##
    public function get_recordings($params = array()) {
        return $this->request('GET', '/Recording/', $params);
    }

    public function get_recording($params = array()) {
        $recording_id = $this->pop($params, 'recording_id');

        return $this->request('GET', '/Recording/'.$recording_id.'/', $params);
    }

    public function delete_recording($params = array()) {
        $recording_id = $this->pop($params, 'recording_id');

        return $this->request('DELETE', '/Recording/'.$recording_id.'/', $params);
    }

    ## Endpoints ##
    public function get_endpoints($params = array()) {
        return $this->request('GET', '/Endpoint/', $params);
    }

    public function create_endpoint($params = array()) {
        return $this->request('POST', '/Endpoint/', $params);
    }

    public function get_endpoint($params = array()) {
        $endpoint_id = $this->pop($params, 'endpoint_id');

        return $this->request('GET', '/Endpoint/'.$endpoint_id.'/', $params);
    }

    public function modify_endpoint($params = array()) {
        $endpoint_id = $this->pop($params, 'endpoint_id');

        return $this->request('POST', '/Endpoint/'.$endpoint_id.'/', $params);
    }

    public function delete_endpoint($params = array()) {
        $endpoint_id = $this->pop($params, 'endpoint_id');

        return $this->request('DELETE', '/Endpoint/'.$endpoint_id.'/', $params);
    }

    ## Incoming Carriers ##
    public function get_incoming_carriers($params = array()) {
        return $this->request('GET', '/IncomingCarrier/', $params);
    }

    public function create_incoming_carrier($params = array()) {
        return $this->request('POST', '/IncomingCarrier/', $params);
    }

    public function get_incoming_carrier($params = array()) {
        $carrier_id = $this->pop($params, 'carrier_id');

        return $this->request('GET', '/IncomingCarrier/'.$carrier_id.'/', $params);
    }

    public function modify_incoming_carrier($params = array()) {
        $carrier_id = $this->pop($params, 'carrier_id');

        return $this->request('POST', '/IncomingCarrier/'.$carrier_id.'/', $params);
    }

    public function delete_incoming_carrier($params = array()) {
        $carrier_id = $this->pop($params, 'carrier_id');

        return $this->request('DELETE', '/IncomingCarrier/'.$carrier_id.'/', $params);
    }

    ## Outgoing Carriers ##
    public function get_outgoing_carriers($params = array()) {
        return $this->request('GET', '/OutgoingCarrier/', $params);
    }

    public function create_outgoing_carrier($params = array()) {
        return $this->request('POST', '/OutgoingCarrier/', $params);
    }

    public function get_outgoing_carrier($params = array()) {
        $carrier_id = $this->pop($params, 'carrier_id');

        return $this->request('GET', '/OutgoingCarrier/'.$carrier_id.'/', $params);
    }

    public function modify_outgoing_carrier($params = array()) {
        $carrier_id = $this->pop($params, 'carrier_id');

        return $this->request('POST', '/OutgoingCarrier/'.$carrier_id.'/', $params);
    }

    public function delete_outgoing_carrier($params = array()) {
        $carrier_id = $this->pop($params, 'carrier_id');

        return $this->request('DELETE', '/OutgoingCarrier/'.$carrier_id.'/', $params);
    }

    ## Outgoing Carrier Routings ##
    public function get_outgoing_carrier_routings($params = array()) {
        return $this->request('GET', '/OutgoingCarrierRouting/', $params);
    }

    public function create_outgoing_carrier_routing($params = array()) {
        return $this->request('POST', '/OutgoingCarrierRouting/', $params);
    }

    public function get_outgoing_carrier_routing($params = array()) {
        $routing_id = $this->pop($params, 'routing_id');

        return $this->request('GET', '/OutgoingCarrierRouting/'.$routing_id.'/', $params);
    }

    public function modify_outgoing_carrier_routing($params = array()) {
        $routing_id = $this->pop($params, 'routing_id');

        return $this->request('POST', '/OutgoingCarrierRouting/'.$routing_id.'/', $params);
    }

    public function delete_outgoing_carrier_routing($params = array()) {
        $routing_id = $this->pop($params, 'routing_id');

        return $this->request('DELETE', '/OutgoingCarrierRouting/'.$routing_id.'/', $params);
    }

    ## Pricing ##
    public function pricing($params = array()) {
        return $this->request('GET', '/Pricing/', $params);
    }

    ## Outgoing Carriers ##

    ## To be added here ##

    ## Message ##
    public function send_message($params = array()) {
        return $this->request('POST', '/Message/', $params);
    }

    public function get_messages($params = array()) {
        return $this->request('GET', '/Message/', $params);
    }

    public function get_message($params = array()) {
        $record_id = $this->pop($params, 'record_id');

        return $this->request('GET', '/Message/'.$record_id.'/', $params);
    }
}


/* XML */

class Element {
    protected $nestables = array();

    protected $valid_attributes = array();

    protected $attributes = array();

    protected $name;

    protected $body = null;

    protected $childs = array();

    function __construct($body = '', $attributes = array()) {
        $this->attributes = $attributes;
        if ((!$attributes) || ($attributes === null)) {
            $this->attributes = array();
        }

        $this->name = preg_replace('/^'.__NAMESPACE__.'\\\\/', '', get_class($this));
        //$this->name = get_class($this);

        $this->body = $body;
        foreach ($this->attributes as $key => $value) {
            if (!in_array($key, $this->valid_attributes)) {
                throw new PlivoError("invalid attribute ".$key." for ".$this->name);
            }
            $this->attributes[ $key ] = $this->convert_value($value);
        }
    }

    protected function convert_value($v) {
        if ($v === true) {
            return "true";
        }
        if ($v === false) {
            return "false";
        }
        if ($v === null) {
            return "none";
        }
        if ($v === "get") {
            return "GET";
        }
        if ($v === "post") {
            return "POST";
        }

        return $v;
    }

    function addSpeak($body = null, $attributes = array()) {
        return $this->add(new Speak($body, $attributes));
    }

    function addPlay($body = null, $attributes = array()) {
        return $this->add(new Play($body, $attributes));
    }

    function addDial($body = null, $attributes = array()) {
        return $this->add(new Dial($body, $attributes));
    }

    function addNumber($body = null, $attributes = array()) {
        return $this->add(new Number($body, $attributes));
    }

    function addUser($body = null, $attributes = array()) {
        return $this->add(new User($body, $attributes));
    }

    function addGetDigits($attributes = array()) {
        return $this->add(new GetDigits($attributes));
    }

    function addRecord($attributes = array()) {
        return $this->add(new Record($attributes));
    }

    function addHangup($attributes = array()) {
        return $this->add(new Hangup($attributes));
    }

    function addRedirect($body = null, $attributes = array()) {
        return $this->add(new Redirect($body, $attributes));
    }

    function addWait($attributes = array()) {
        return $this->add(new Wait($attributes));
    }

    function addConference($body = null, $attributes = array()) {
        return $this->add(new Conference($body, $attributes));
    }

    function addPreAnswer($attributes = array()) {
        return $this->add(new PreAnswer($attributes));
    }

    function addMessage($body = null, $attributes = array()) {
        return $this->add(new Message($body, $attributes));
    }

    function addDTMF($body = null, $attributes = array()) {
        return $this->add(new DTMF($body, $attributes));
    }

    public function getName() {
        return $this->name;
    }

    protected function add($element) {
        if (!in_array($element->getName(), $this->nestables)) {
            throw new PlivoError($element->getName()." not nestable in ".$this->getName());
        }
        $this->childs[] = $element;

        return $element;
    }

    public function setAttributes($xml) {
        foreach ($this->attributes as $key => $value) {
            $xml->addAttribute($key, $value);
        }
    }

    public function asChild($xml) {
        if ($this->body) {
            $child_xml = $xml->addChild($this->getName(), htmlspecialchars($this->body));
        } else {
            $child_xml = $xml->addChild($this->getName());
        }
        $this->setAttributes($child_xml);
        foreach ($this->childs as $child) {
            $child->asChild($child_xml);
        }
    }

    public function toXML($header = false) {
        if (!(isset($xmlstr))) {
            $xmlstr = '';
        }

        if ($this->body) {
            $xmlstr.= "<".$this->getName().">".htmlspecialchars($this->body)."</".$this->getName().">";
        } else {
            $xmlstr.= "<".$this->getName()."></".$this->getName().">";
        }
        if ($header === true) {
            $xmlstr = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>".$xmlstr;
        }
        $xml = new \SimpleXMLElement($xmlstr);
        $this->setAttributes($xml);
        foreach ($this->childs as $child) {
            $child->asChild($xml);
        }

        return $xml->asXML();
    }

    public function __toString() {
        return $this->toXML();
    }

}

class Response extends Element {
    protected $nestables = array(
        'Speak',
        'Play',
        'GetDigits',
        'Record',
        'Dial',
        'Redirect',
        'Wait',
        'Hangup',
        'PreAnswer',
        'Conference',
        'DTMF',
        'Message'
   );

    function __construct() {
        parent::__construct(null);
    }

    public function toXML($header = false) {
        $xml = parent::toXML(true);

        return $xml;
    }
}


class Speak extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('voice', 'language', 'loop');

    function __construct($body, $attributes = array()) {
        if (!$body) {
            throw new PlivoError("No text set for ".$this->getName());
        } else {
           $body = mb_encode_numericentity($body, array(0x80, 0xffff, 0, 0xffff));
        }
        parent::__construct($body, $attributes);
    }
}

class Play extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('loop');

    function __construct($body, $attributes = array()) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No url set for ".$this->getName());
        }
    }
}

class Wait extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('length', 'silence', 'min_silence', 'minSilence', 'beep');

    function __construct($attributes = array()) {
        parent::__construct(null, $attributes);
    }
}

class Redirect extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('method');

    function __construct($body, $attributes = array()) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No url set for ".$this->getName());
        }
    }
}

class Hangup extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('schedule', 'reason');

    function __construct($attributes = array()) {
        parent::__construct(null, $attributes);
    }
}

class GetDigits extends Element {
    protected $nestables = array('Speak', 'Play', 'Wait');

    protected $valid_attributes = array(
        'action',
        'method',
        'timeout',
        'digitTimeout',
        'numDigits',
        'retries',
        'invalidDigitsSound',
        'validDigits',
        'playBeep',
        'redirect',
        "finishOnKey",
        'digitTimeout',
        'log'
   );

    function __construct($attributes = array()) {
        parent::__construct(null, $attributes);
    }
}

class Number extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('sendDigits', 'sendOnPreanswer', 'sendDigitsMode');

    function __construct($body, $attributes = array()) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No number set for ".$this->getName());
        }
    }
}

class User extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('sendDigits', 'sendOnPreanswer', 'sipHeaders');

    function __construct($body, $attributes = array()) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No user set for ".$this->getName());
        }
    }
}

class Dial extends Element {
    protected $nestables = array('Number', 'User');

    protected $valid_attributes = array(
        'action',
        'method',
        'timeout',
        'hangupOnStar',
        'timeLimit',
        'callerId',
        'callerName',
        'confirmSound',
        'dialMusic',
        'confirmKey',
        'redirect',
        'callbackUrl',
        'callbackMethod',
        'digitsMatch',
        'digitsMatchBLeg',
        'sipHeaders'
   );

    function __construct($attributes = array()) {
        parent::__construct(null, $attributes);
    }
}

class Conference extends Element {
    protected $nestables = array();

    protected $valid_attributes = array(
        'muted',
        'beep',
        'startConferenceOnEnter',
        'endConferenceOnExit',
        'waitSound',
        'enterSound',
        'exitSound',
        'timeLimit',
        'hangupOnStar',
        'maxMembers',
        'record',
        'recordFileFormat',
        'recordWhenAlone',
        'action',
        'method',
        'redirect',
        'digitsMatch',
        'callbackUrl',
        'callbackMethod',
        'stayAlone',
        'floorEvent',
        'transcriptionType',
        'transcriptionUrl',
        'transcriptionMethod',
        'relayDTMF'
   );

    function __construct($body, $attributes = array()) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No conference name set for ".$this->getName());
        }
    }
}

class Record extends Element {
    protected $nestables = array();

    protected $valid_attributes = array(
        'action',
        'method',
        'timeout',
        'finishOnKey',
        'maxLength',
        'playBeep',
        'recordSession',
        'startOnDialAnswer',
        'redirect',
        'fileFormat',
        'callbackUrl',
        'callbackMethod',
        'transcriptionType',
        'transcriptionUrl',
        'transcriptionMethod'
   );

    function __construct($attributes = array()) {
        parent::__construct(null, $attributes);
    }
}

class PreAnswer extends Element {
    protected $nestables = array('Play', 'Speak', 'GetDigits', 'Wait', 'Redirect', 'Message', 'DTMF');

    protected $valid_attributes = array();

    function __construct($attributes = array()) {
        parent::__construct(null, $attributes);
    }
}

class Message extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('src', 'dst', 'type', 'callbackMethod', 'callbackUrl');

    function __construct($body, $attributes = array()) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No text set for ".$this->getName());
        }
    }
}

class DTMF extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('async');

    function __construct($body, $attributes = array()) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No digits set for ".$this->getName());
        }
    }
}
