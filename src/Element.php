<?php
/*
 * Copyright (c) Plivo
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Plivo;

class Element
{
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

    function addDTMF($body=NULL, $attributes=array()) {
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
            $child->asChild($xml);
        }
        return $xml->asXML();
    }

    public function __toString() {
        return $this->toXML();
    }
}