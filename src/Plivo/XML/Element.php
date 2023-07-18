<?php

namespace Plivo\XML;

use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Element
 * @package Plivo\XML
 */
class Element {
    /**
     * @var array
     */
    protected $nestables = [];

    protected $valid_attributes = [];

    protected $attributes = [];

    protected $name;

    protected $voice_attribute = 'voice';

    protected $body = null;

    protected $childs = [];

    /**
     * Element constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body = '', $attributes = []) {
        $this->attributes = $attributes;
        if ((!$attributes) || ($attributes === null)) {
            $this->attributes = [];
        }
        $this->name =
            substr(
                get_class($this),
                strrpos(get_class($this), '\\') + 1
            );
        $this->name = $this->name === "Break_"?"break":$this->name;
        $this->body = $body;
        foreach ($this->attributes as $key => $value) {
            if (!in_array($key, $this->valid_attributes)) {
                throw new PlivoXMLException(
                    "invalid attribute ".$key." for ".$this->name);
            }
            $this->attributes[ $key ] = $this->convertValue($value);
        }
    }

    /**
     * @param $v
     * @return string
     */
    protected function convertValue($v) {

        switch($v){
            case "true":
                return "true";
                break;
            case "false":
                return "false";
                break;
            case null:
                return "none";
                break;
            case "get":
                return strtoupper($v);
                break;
            case "post":
                return strtoupper($v);
                break;
            case "man":
                return strtoupper($v);
                break;
            case "woman":
                return strtoupper($v);
                break;
        }

        return $v;
    }
    /**
     * @param null
     * @throws PlivoXMLException
     */
    function checkIsSSMLSupported(){
        $attribute = $this->voice_attribute;
        $position = count($this->childs)-1;
        $speak_element = simplexml_load_string($this->childs[$position]);
        if($speak_element->attributes()->$attribute == 'WOMAN' ||
            $speak_element->attributes()->$attribute == 'MAN'){
            throw new PlivoXMLException(
                "SSML support is available only for Amazon Polly! ".$this->name);
        }
    }

    /**
     * @param string $body
     * @param array $attributes
     * @return mixed
     */
    function addSpeak($body = null, $attributes = []) {
        $this->add(new Speak($body, $attributes));
        return $this;
    }

    /**
     * @param string $body
     * @param null $attributes
     * @return mixed
     */
    function continueSpeak($body = null) {
        $element = new Cont($body);
        $position = count($this->childs)-1;
        $this->childs[$position]->add($element);
        return $this;
    }

    /**
     * @param null $body
     * @param array $attributes
     * @return mixed
     */
    function addBreak($body = null, $attributes = []) {
        $this->checkIsSSMLSupported();
        $position = count($this->childs)-1;
        $element = new Break_($body,$attributes);
        $this->childs[$position]->add($element);
        return $this;
    }

    /**
     * @param string $body
     * @param array $attributes
     * @return mixed
     */
    function addEmphasis($body = null, $attributes = []) {
        $this->checkIsSSMLSupported();
        $position = count($this->childs)-1;
        $element = new Emphasis($body,$attributes);
        $this->childs[$position]->add($element);
        return $this;
    }

    /**
     * @param string $body
     * @param array $attributes
     * @return mixed
     */
    function addLang($body = null, $attributes = []) {
        $this->checkIsSSMLSupported();
        $position = count($this->childs)-1;
        $element = new Lang($body,$attributes);
        $this->childs[$position]->add($element);
        return $this;
    }

    /**
     * @param string $body
     * @param array $attributes
     * @return mixed
     */
    function addP($body = null, $attributes = []) {
        $this->checkIsSSMLSupported();
        $position = count($this->childs)-1;
        $element = new P($body,$attributes);
        $this->childs[$position]->add($element);
        return $this;
    }

    /**
     * @param string $body
     * @param array $attributes
     * @return mixed
     */
    function addPhoneme($body = null, $attributes = []) {
        $this->checkIsSSMLSupported();
        $position = count($this->childs)-1;
        $element = new Phoneme($body,$attributes);
        $this->childs[$position]->add($element);
        return $this;
    }

    /**
     * @param string $body
     * @param array $attributes
     * @return mixed
     */
    function addProsody($body = null, $attributes = []) {
        $this->checkIsSSMLSupported();
        $position = count($this->childs)-1;
        $element = new Prosody($body,$attributes);
        $this->childs[$position]->add($element);
        return $this;
    }

    /**
     * @param string $body
     * @param array $attributes
     * @return mixed
     */
    function addS($body = null, $attributes = []) {
        $this->checkIsSSMLSupported();
        $position = count($this->childs)-1;
        $element = new S($body,$attributes);
        $this->childs[$position]->add($element);
        return $this;
    }

    /**
     * @param string $body
     * @param array $attributes
     * @return mixed
     */
    function addSayAs($body = null, $attributes = []) {
        $this->checkIsSSMLSupported();
        $position = count($this->childs)-1;
        $element = new SayAs($body,$attributes);
        $element->setName('say-as');
        $this->childs[$position]->add($element);
        return $this;
    }

    /**
     * @param string $body
     * @param array $attributes
     * @return mixed
     */
    function addSub($body = null, $attributes = []) {
        $this->checkIsSSMLSupported();
        $position = count($this->childs)-1;
        $element = new Sub($body,$attributes);
        $this->childs[$position]->add($element);
        return $this;
    }

    /**
     * @param string $body
     * @param array $attributes
     * @return mixed
     */
    function addW($body = null, $attributes = []) {
        $this->checkIsSSMLSupported();
        $position = count($this->childs)-1;
        $element = new W($body,$attributes);
        $this->childs[$position]->add($element);
        return $this;
    }

    /**
     * @param string $body
     * @param array $attributes
     * @return mixed
     */
    function addPlay($body = null, $attributes = []) {
        return $this->add(new Play($body, $attributes));
    }

    /**
     * @param null $body
     * @param array $attributes
     * @return mixed
     */
    function addDial($body = null, $attributes = []) {
        return $this->add(new Dial($body, $attributes));
    }

    /**
     * @param null $body
     * @param array $attributes
     * @return mixed
     */
    function addNumber($body = null, $attributes = []) {
        return $this->add(new Number($body, $attributes));
    }

    /**
     * @param null $body
     * @param array $attributes
     * @return mixed
     */
    function addUser($body = null, $attributes = []) {
        return $this->add(new User($body, $attributes));
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    function addGetDigits($attributes = []) {
        return $this->add(new GetDigits($attributes));
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    function addGetInput($attributes = []) {
        return $this->add(new GetInput($attributes));
    }
    /**
     * @param array $attributes
     * @return mixed
     */
    function addRecord($attributes = []) {
        return $this->add(new Record($attributes));
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    function addHangup($attributes = []) {
        return $this->add(new Hangup($attributes));
    }

    /**
     * @param null $body
     * @param array $attributes
     * @return mixed
     */
    function addRedirect($body = null, $attributes = []) {
        return $this->add(new Redirect($body, $attributes));
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    function addWait($attributes = []) {
        return $this->add(new Wait($attributes));
    }

    /**
     * @param null $body
     * @param array $attributes
     * @return mixed
     */
    function addConference($body = null, $attributes = []) {
        return $this->add(new Conference($body, $attributes));
    }

    function addMultiPartyCall($body = null, $attributes = []) {
        return $this->add(new MultiPartyCall($body, $attributes));
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    function addPreAnswer($attributes = []) {
        return $this->add(new PreAnswer($attributes));
    }

    /**
     * @param null $body
     * @param array $attributes
     * @return mixed
     */
    function addMessage($body = null, $attributes = []) {
        return $this->add(new Message($body, $attributes));
    }

    /**
     * @param null $body
     * @param array $attributes
     * @return mixed
     */
    function addDTMF($body = null, $attributes = []) {
        return $this->add(new DTMF($body, $attributes));
    }

    /**
     * @param string $body
     * @param array $attributes
     * @return mixed
     */
    function addStream($body = null, $attributes = []) {
        $this->add(new Stream($body, $attributes));
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param name $name
     */
    public function setName($name) {
        $this->name = $name;
    }


    /**
     * @param Element $element
     * @return mixed
     * @throws PlivoXMLException
     */
    public function add($element) {
        if ( !in_array($element->getName(), $this->nestables)) {
            throw new PlivoXMLException($element->getName()." not nestable in ".$this->getName());
        }
        $this->childs[] = $element;

        return $element;
    }

    /**
     * @param \SimpleXMLElement $xml
     */
    public function setAttributes($xml) {
        foreach ($this->attributes as $key => $value) {
            if($key === 'xmllang'){
                $xml->addAttribute('xml:lang', $value, "http://schema.omg.org/spec/XMI/2.1");
            } else {
                $xml->addAttribute($key, $value);
            }
        }
    }

    /**
     * @param \SimpleXMLElement $xml
     */
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

    /**
     * @param bool $header
     * @return mixed
     */
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
        $xml_string = $xml->asXML();

        $xml_string = str_replace("<cont>"," ",$xml_string);
        $xml_string = str_replace("</cont>"," ",$xml_string);

        return $xml_string;
    }

    /**
     * @return mixed
     */
    public function __toString() {
        return $this->toXML();
    }

}
