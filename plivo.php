<?php
require_once 'HTTP/Request2.php';


class PlivoError extends Exception { }


function validate_signature($uri, $post_params=array(), $signature, $auth_token) {
    ksort($post_params);
    foreach($post_params as $key => $value) {
        $uri .= "$key$value";
    }
    $generated_signature = base64_encode(hash_hmac("sha1",$uri, $auth_token, true));
    return $generated_signature == $signature;
}


class RestAPI {
    private $api;

    private $auth_id;

    private $auth_token;

    function __construct($auth_id, $auth_token, $url="https://api.plivo.com", $version="v1") {
        if ((!isset($auth_id)) || (!$auth_token)) {
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

    private function request($method, $path, $params=array()) {
        $url = $this->api.rtrim($path, '/').'/';
        if (!strcmp($method, "POST")) {
            $req = new HTTP_Request2($url, HTTP_Request2::METHOD_POST);
            $req->setHeader('Content-type: application/json');
            $req->setBody(json_encode($params));
        } else if (!strcmp($method, "GET")) {
            $req = new HTTP_Request2($url, HTTP_Request2::METHOD_GET);
            $url = $req->getUrl();
            $url->setQueryVariables($params);
        } else if (!strcmp($method, "DELETE")) {
            $req = new HTTP_Request2($url, HTTP_Request2::METHOD_DELETE);
            $url = $req->getUrl();
            $url->setQueryVariables($params);
        }
        $req->setAdapter('curl');
        $req->setConfig(array('timeout' => 30));
        $req->setAuth($this->auth_id, $this->auth_token, HTTP_Request2::AUTH_BASIC);
        $req->setHeader(array(
            'Connection' => 'close',
            'User-Agent' => 'PHPPlivo',
        ));
        $r = $req->send();
        $status = $r->getStatus();
        $body = $r->getbody();
        $response = json_decode($body, true);
        return array("status" => $status, "response" => $response);
    }

    private function pop($params, $key) {
        $val = $params[$key];
        if (!$val) {
            throw new PlivoError($key." parameter not found");
        }
        unset($params[$key]);
        return $val;
    }

    ## Accounts ##
    public function get_account($params=array()) {
        return $this->request('GET', '', $params);
    }

    public function modify_account($params=array()) {
        return $this->request('POST', '', $params);
    }

    public function get_subaccounts($params=array()) {
        return $this->request('GET', '/Subaccount/', $params);
    }

    public function create_subaccount($params=array()) {
        return $this->request('POST', '/Subaccount/', $params);
    }

    public function get_subaccount($params=array()) {
        $subauth_id = $this->pop(&$params, "subauth_id");
        return $this->request('GET', '/Subaccount/'.$subauth_id.'/');
    }

    public function modify_subaccount($params=array()) {
        $subauth_id = $this->pop(&$params, "subauth_id");
        return $this->request('POST', '/Subaccount/'.$subauth_id.'/', $params);
    }

    public function delete_subaccount($params=array()) {
        $subauth_id = $this->pop(&$params, "subauth_id");
        return $this->request('DELETE', '/Subaccount/'.$subauth_id.'/');
    }

    ## Applications ##
    public function get_applications($params=array()) {
        return $this->request('GET', '/Application/', $params);
    }

    public function create_application($params=array()) {
        return $this->request('POST', '/Application/', $params);
    }

    public function get_application($params=array()) {
        $app_id = $this->pop(&$params, "app_id");
        return $this->request('GET', '/Application/'.$app_id.'/');
    }

    public function modify_application($params=array()) {
        $app_id = $this->pop(&$params, "app_id");
        return $this->request('POST', '/Application/'.$app_id.'/', $params);
    }

    public function delete_application($params=array()) {
        $app_id = $this->pop(&$params, "app_id");
        return $this->request('DELETE', '/Application/'.$app_id.'/');
    }

    ## Numbers ##
    public function get_numbers($params=array()) {
        return $this->request('GET', '/Number/', $params);
    }

    public function search_numbers($params=array()) {
        return $this->request('GET', '/AvailableNumber/', $params);
    }

    public function get_number($params=array()) {
        $number = $this->pop(&$params, "number");
        return $this->request('GET', '/Number/'.$number.'/');
    }

    public function rent_number($params=array()) {
        $number = $this->pop(&$params, "number");
        return $this->request('POST', '/AvailableNumber/'.$number.'/');
    }

    public function unrent_number($params=array()) {
        $number = $this->pop(&$params, "number");
        return $this->request('DELETE', '/Number/'.$number.'/');
    }

    public function link_application_number($params=array()) {
        $number = $this->pop(&$params, "number");
        return $this->request('POST', '/Number/'.$number.'/', $params);
    }

    public function unlink_application_number($params=array()) {
        $number = $this->pop(&$params, "number");
        $params = array("app_id" => "");
        return $this->request('POST', '/Number/'.$number.'/', $params);
    }

    ## Schedule ##
    public function get_scheduled_tasks($params=array()) {
        return $this->request('GET', '/Schedule/');
    }

    public function cancel_scheduled_task($params=array()) {
        $task_id = $this->pop(&$params, "task_id");
        return $this->request('DELETE', '/Schedule/'.$task_id.'/');
    }

    ## Calls ##
    public function get_cdrs($params=array()) {
        return $this->request('GET', '/Call/', $params);
    }

    public function get_cdr($params=array()) {
        $record_id = $this->pop(&$params, 'record_id');
        return $this->request('GET', '/Call/'.$record_id.'/');
    }

    public function get_live_calls($params=array()) {
        return $this->request('GET', '/Call/', array('status' => 'live'));
    }

    public function get_live_call($params=array()) {
        $call_uuid = $this->pop(&$params, 'call_uuid');
        return $this->request('GET', '/Call/'.$call_uuid.'/', array('status' => 'live'));
    }

    public function make_call($params=array()) {
        return $this->request('POST', '/Call/', $params);
    }

    public function hangup_all_calls($params=array()) {
        return $this->request('DELETE', '/Call/');
    }

    public function transfer_call($params=array()) {
        $call_uuid = $this->pop(&$params, 'call_uuid');
        return $this->request('POST', '/Call/'.$call_uuid.'/', $params);
    }

    public function hangup_call($params=array()) {
        $call_uuid = $this->pop(&$params, 'call_uuid');
        return $this->request('DELETE', '/Call/'.$call_uuid.'/');
    }

    public function record($params=array()) {
        $call_uuid = $this->pop(&$params, 'call_uuid');
        return $this->request('POST', '/Call/'.$call_uuid.'/Record/', $params);
    }
        
    public function stop_record($params=array()) {
        $call_uuid = $this->pop(&$params, 'call_uuid');
        return $this->request('DELETE', '/Call/'.$call_uuid.'/Record/', $params);
    }

    public function play($params=array()) {
        $call_uuid = $this->pop(&$params, 'call_uuid');
        return $this->request('POST', '/Call/'.$call_uuid.'/Play/', $params);
    }
        
    public function stop_play($params=array()) {
        $call_uuid = $this->pop(&$params, 'call_uuid');
        return $this->request('DELETE', '/Call/'.$call_uuid.'/Play/', $params);
    }

    public function speak($params=array()) {
        $call_uuid = $this->pop(&$params, 'call_uuid');
        return $this->request('POST', '/Call/'.$call_uuid.'/Speak/', $params);
    }
        
    public function send_digits($params=array()) {
        $call_uuid = $this->pop(&$params, 'call_uuid');
        return $this->request('POST', '/Call/'.$call_uuid.'/DTMF/', $params);
    }

    ## Calls requests ##
    public function hangup_request($params=array()) {
        $request_uuid = $this->pop(&$params, 'request_uuid');
        return $this->request('DELETE', '/Request/'.$request_uuid.'/');
    }

    ## Conferences ##
    public function get_live_conferences($params=array()) {
        return $this->request('GET', '/Conference/', $params);
    }

    public function hangup_all_conferences($params=array()) {
        return $this->request('DELETE', '/Conference/');
    }

    public function get_live_conference($params=array()) {
        $conference_name = $this->pop(&$params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        return $this->request('GET', '/Conference/'.$conference_name.'/', $params);
    }

    public function hangup_conference($params=array()) {
        $conference_name = $this->pop(&$params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        return $this->request('DELETE', '/Conference/'.$conference_name.'/');
    }

    public function hangup_member($params=array()) {
        $conference_name = $this->pop(&$params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop(&$params, 'member_id');
        return $this->request('DELETE', '/Conference/'.$conference_name.'/Member/'.$member_id.'/');
    }

    public function play_member($params=array()) {
        $conference_name = $this->pop(&$params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop(&$params, 'member_id');
        return $this->request('POST', '/Conference/'.$conference_name.'/Member/'.$member_id.'/Play/', $params);
    }
        
    public function stop_play_member($params=array()) {
        $conference_name = $this->pop(&$params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop(&$params, 'member_id');
        return $this->request('DELETE', '/Conference/'.$conference_name.'/Member/'.$member_id.'/Play/');
    }

    public function speak_member($params=array()) {
        $conference_name = $this->pop(&$params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop(&$params, 'member_id');
        return $this->request('POST', '/Conference/'.$conference_name.'/Member/'.$member_id.'/Speak/', $params);
    }

    public function deaf_member($params=array()) {
        $conference_name = $this->pop(&$params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop(&$params, 'member_id');
        return $this->request('POST', '/Conference/'.$conference_name.'/Member/'.$member_id.'/Deaf/', $params);
    }

    public function undeaf_member($params=array()) {
        $conference_name = $this->pop(&$params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop(&$params, 'member_id');
        return $this->request('DELETE', '/Conference/'.$conference_name.'/Member/'.$member_id.'/Deaf/');
    }

    public function mute_member($params=array()) {
        $conference_name = $this->pop(&$params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop(&$params, 'member_id');
        return $this->request('POST', '/Conference/'.$conference_name.'/Member/'.$member_id.'/Mute/', $params);
    }

    public function unmute_member($params=array()) {
        $conference_name = $this->pop(&$params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop(&$params, 'member_id');
        return $this->request('DELETE', '/Conference/'.$conference_name.'/Member/'.$member_id.'/Mute/');
    }

    public function kick_member($params=array()) {
        $conference_name = $this->pop(&$params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        $member_id = $this->pop(&$params, 'member_id');
        return $this->request('POST', '/Conference/'.$conference_name.'/Member/'.$member_id.'/Kick/', $params);
    }

    public function record_conference($params=array()) { 
        $conference_name = $this->pop(&$params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        return $this->request('POST', '/Conference/'.$conference_name.'/Record/', $params);
    }

    public function stop_record_conference($params=array()) { 
        $conference_name = $this->pop(&$params, 'conference_name');
        $conference_name = rawurlencode($conference_name);
        return $this->request('DELETE', '/Conference/'.$conference_name.'/Record/');
    }

    ## Recordings ##
    public function get_recordings($params=array()) {
        return $this->request('GET', '/Recording/', $params);
    }

    public function get_recording($params=array()) {
        $recording_id = $this->pop(&$params, 'recording_id');
        return $this->request('GET', '/Recording/'.$recording_id.'/');
    }

    ## Endpoints ##
    public function get_endpoints($params=array()) {
        return $this->request('GET', '/Endpoint/', $params);
    }

    public function create_endpoint($params=array()) {
        return $this->request('POST', '/Endpoint/', $params);
    }

    public function get_endpoint($params=array()) {
        $endpoint_id = $this->pop(&$params, 'endpoint_id');
        return $this->request('GET', '/Endpoint/'.$endpoint_id.'/');
    }

    public function modify_endpoint($params=array()) {
        $endpoint_id = $this->pop(&$params, 'endpoint_id');
        return $this->request('POST', '/Endpoint/'.$endpoint_id.'/', $params);
    }

    public function delete_endpoint($params=array()) {
        $endpoint_id = $this->pop(&$params, 'endpoint_id');
        return $this->request('DELETE', '/Endpoint/'.$endpoint_id.'/');
    }

    ## Carriers ##
    public function get_carriers($params=array()) {
        return $this->request('GET', '/Carrier/', $params);
    }

    public function create_carrier($params=array()) {
        return $this->request('POST', '/Carrier/', $params);
    }

    public function get_carrier($params=array()) {
        $carrier_id = $this->pop(&$params, 'carrier_id');
        return $this->request('GET', '/Carrier/'.$carrier_id.'/');
    }

    public function modify_carrier($params=array()) {
        $carrier_id = $this->pop(&$params, 'carrier_id');
        return $this->request('POST', '/Carrier/'.$carrier_id.'/', $params);
    }

    public function delete_carrier($params=array()) {
        $carrier_id = $this->pop(&$params, 'carrier_id');
        return $this->request('DELETE', '/Carrier/'.$carrier_id.'/');
    }

    ## Carrier Routings ##
    public function get_carrier_routings($params=array()) {
        return $this->request('GET', '/CarrierRouting/', $params);
    }

    public function create_carrier_routing($params=array()) {
        return $this->request('POST', '/CarrierRouting/', $params);
    }

    public function get_carrier_routing($params=array()) {
        $routing_id = $this->pop(&$params, 'routing_id');
        return $this->request('GET', '/CarrierRouting/'.$routing_id.'/');
    }

    public function modify_carrier_routing($params=array()) {
        $routing_id = $this->pop(&$params, 'routing_id');
        return $this->request('POST', '/CarrierRouting/'.$routing_id.'/', $params);
    }

    public function delete_carrier_routing($params=array()) {
        $routing_id = $this->pop(&$params, 'routing_id');
        return $this->request('DELETE', '/CarrierRouting/'.$routing_id.'/');
    }

    ## Message ##
    public function send_message($params=array()) {
        return $this->request('POST', '/Message/', $params);
    }
}


/* XML */

class Element {
    protected $nestables = array();

    protected $valid_attributes = array();

    protected $attributes = array();

    protected $name;

    protected $body = NULL;

    protected $childs = array();

    function __construct($body='', $attributes=array()) {
        $this->attributes = $attributes;
        if ((!$attributes) || ($attributes === null)) {
            $this->attributes = array();
        }
        $this->name = get_class($this);
        $this->body = $body;
        foreach ($this->attributes as $key => $value) {
            if (!in_array($key, $this->valid_attributes)) {
                throw new PlivoError("invalid attribute ".$key." for ".$this->name);
            }
            $this->attributes[$key] = $this->convert_value($value);
        }
    }

    protected function convert_value($v) {
        if ($v === TRUE) {
            return "true";
        } 
        if ($v === FALSE) {
            return "false";
        } 
        if ($v === NULL) {
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

    function addSpeak($body=NULL, $attributes=array()) {
        return $this->add(new Speak($body, $attributes));
    }

    function addPlay($body=NULL, $attributes=array()) {
        return $this->add(new Play($body, $attributes));
    }

    function addDial($body=NULL, $attributes=array()) {
        return $this->add(new Dial($body, $attributes));
    }

    function addNumber($body=NULL, $attributes=array()) {
        return $this->add(new Number($body, $attributes));
    }

    function addUser($body=NULL, $attributes=array()) {
        return $this->add(new User($body, $attributes));
    }

    function addGetDigits($attributes=array()) {
        return $this->add(new GetDigits($attributes));
    }

    function addRecord($attributes=array()) {
        return $this->add(new Record($attributes));
    }

    function addHangup($attributes=array()) {
        return $this->add(new Hangup($attributes));
    }

    function addRedirect($body=NULL, $attributes=array()) {
        return $this->add(new Redirect($body, $attributes));
    }

    function addWait($attributes=array()) {
        return $this->add(new Wait($attributes));
    }

    function addConference($body=NULL, $attributes=array()) {
        return $this->add(new Conference($body, $attributes));
    }

    function addPreAnswer($attributes=array()) {
        return $this->add(new PreAnswer($attributes));
    }

    function addMessage($body=NULL, $attributes=array()) {
        return $this->add(new Message($body, $attributes));
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

    public function setAttributes(&$xml) {
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
            $child->asChild(&$child_xml);
        }
    }

    public function toXML($header=FALSE) {
        if (!(isset($xmlstr))) {
            $xmlstr = '';
        }

        if ($this->body) {
            $xmlstr .= "<".$this->getName().">".htmlspecialchars($this->body)."</".$this->getName().">";
        } else {
            $xmlstr .= "<".$this->getName()."></".$this->getName().">";
        }
        if ($header === TRUE) {
            $xmlstr = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>".$xmlstr;
        }
        $xml = new SimpleXMLElement($xmlstr);
        $this->setAttributes($xml);
        foreach ($this->childs as $child) {
            $child->asChild(&$xml);
        }
        return $xml->asXML();
    }

    public function __toString() {
        return $this->toXML();
    }

}

class Response extends Element {
    protected $nestables = array('Speak', 'Play', 'GetDigits', 'Record',
                                 'Dial', 'Redirect', 'Wait', 'Hangup', 
                                 'PreAnswer', 'Conference');

    function __construct() {
        parent::__construct(NULL);
    }

    public function toXML() {
        $xml = parent::toXML($header=TRUE);
        return $xml;
    }
}


class Speak extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('voice', 'language', 'loop');

    function __construct($body, $attributes=array()) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No text set for ".$this->getName());
        }
    }
}

class Play extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('loop');

    function __construct($body, $attributes=array()) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No url set for ".$this->getName());
        }
    }
}

class Wait extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('length');

    function __construct($attributes=array()) {
        parent::__construct(NULL, $attributes);
    }
}

class Redirect extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('method');

    function __construct($body, $attributes=array()) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No url set for ".$this->getName());
        }
    }
}

class Hangup extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('schedule', 'reason');

    function __construct($attributes=array()) {
        parent::__construct(NULL, $attributes);
    }
}

class GetDigits extends Element {
    protected $nestables = array('Speak', 'Play', 'Wait');

    protected $valid_attributes = array('action', 'method', 'timeout', 'finishOnKey',
                                        'numDigits', 'retries', 'invalidDigitsSound',
                                        'validDigits', 'playBeep');

    function __construct($attributes=array()) {
        parent::__construct(NULL, $attributes);
    }
}

class Number extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('sendDigits', 'sendOnPreanswer');

    function __construct($body, $attributes=array()) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No number set for ".$this->getName());
        }
    }
}

class User extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('sendDigits', 'sendOnPreanswer');

    function __construct($body, $attributes=array()) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No user set for ".$this->getName());
        }
    }
}

class Dial extends Element {
    protected $nestables = array('Number', 'User');

    protected $valid_attributes = array('action','method','timeout','hangupOnStar',
                                        'timeLimit','callerId', 'callerName', 'confirmSound',
                                        'dialMusic', 'confirmKey', 'redirect',
                                        'callbackUrl', 'callbackMethod', 'digitsMatch');

    function __construct($attributes=array()) {
        parent::__construct(NULL, $attributes);
    }
}

class Conference extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('muted','beep','startConferenceOnEnter',
                                        'endConferenceOnExit','waitSound','enterSound', 'exitSound',
                                        'timeLimit', 'hangupOnStar', 'maxMembers',
                                        'record', 'recordFileFormat', 'action', 'method', 'redirect',
                                        'digitsMatch', 'callbackUrl', 'callbackMethod',
                                        'stayAlone', 'floorEvent');

    function __construct($body, $attributes=array()) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No conference name set for ".$this->getName());
        }
    }
}

class Record extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('action', 'method', 'timeout','finishOnKey',
                                        'maxLength', 'playBeep', 'recordSession',
                                        'startOnDialAnswer', 'redirect', 'fileFormat');

    function __construct($attributes=array()) {
        parent::__construct(NULL, $attributes);
    }
}

class PreAnswer extends Element {
    protected $nestables = array('Play', 'Speak', 'GetDigits', 'Wait', 'Redirect', 'Message');

    protected $valid_attributes = array();

    function __construct($attributes=array()) {
        parent::__construct(NULL, $attributes);
    }
}

class Message extends Element {
    protected $nestables = array();

    protected $valid_attributes = array('src', 'dst', 'type', 'callbackMethod', 'callbackUrl');

    function __construct($body, $attributes=array()) {
        parent::__construct($body, $attributes);
        if (!$body) {
            throw new PlivoError("No text set for ".$this->getName());
        }
    }
}



?>
