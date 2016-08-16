<?php

namespace Plivo;

class Element
{
    protected $nestables = [];
    protected $valid_attributes = [];
    protected $attributes = [];
    protected $name;
    protected $body = null;
    protected $childs = [];

    function __construct($body = '', $attributes = [])
    {
        $this->attributes = $attributes;
        if ((!$attributes) || ($attributes === null)) {
            $this->attributes = [];
        }

        $this->name = preg_replace('/^' . __NAMESPACE__ . '\\\\/', '', get_class($this));
        //$this->name = get_class($this);

        $this->body = $body;
        foreach ($this->attributes as $key => $value) {
            if (!in_array($key, $this->valid_attributes)) {
                throw new PlivoError("invalid attribute " . $key . " for " . $this->name);
            }
            $this->attributes[$key] = $this->convert_value($value);
        }
    }

    protected function convert_value($v)
    {
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

    function addSpeak($body = null, $attributes = [])
    {
        return $this->add(new Speak($body, $attributes));
    }

    function addPlay($body = null, $attributes = [])
    {
        return $this->add(new Play($body, $attributes));
    }

    function addDial($body = null, $attributes = [])
    {
        return $this->add(new Dial($body, $attributes));
    }

    function addNumber($body = null, $attributes = [])
    {
        return $this->add(new Number($body, $attributes));
    }

    function addUser($body = null, $attributes = [])
    {
        return $this->add(new User($body, $attributes));
    }

    function addGetDigits($attributes = [])
    {
        return $this->add(new GetDigits($attributes));
    }

    function addRecord($attributes = [])
    {
        return $this->add(new Record($attributes));
    }

    function addHangup($attributes = [])
    {
        return $this->add(new Hangup($attributes));
    }

    function addRedirect($body = null, $attributes = [])
    {
        return $this->add(new Redirect($body, $attributes));
    }

    function addWait($attributes = [])
    {
        return $this->add(new Wait($attributes));
    }

    function addConference($body = null, $attributes = [])
    {
        return $this->add(new Conference($body, $attributes));
    }

    function addPreAnswer($attributes = [])
    {
        return $this->add(new PreAnswer($attributes));
    }

    function addMessage($body = null, $attributes = [])
    {
        return $this->add(new Message($body, $attributes));
    }

    function addDTMF($body = null, $attributes = [])
    {
        return $this->add(new DTMF($body, $attributes));
    }

    public function getName()
    {
        return $this->name;
    }

    protected function add($element)
    {
        if (!in_array($element->getName(), $this->nestables)) {
            throw new PlivoError($element->getName() . " not nestable in " . $this->getName());
        }
        $this->childs[] = $element;

        return $element;
    }

    public function setAttributes($xml)
    {
        foreach ($this->attributes as $key => $value) {
            $xml->addAttribute($key, $value);
        }
    }

    public function asChild($xml)
    {
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

    public function toXML($header = false)
    {
        if (!(isset($xmlstr))) {
            $xmlstr = '';
        }

        if ($this->body) {
            $xmlstr .= "<" . $this->getName() . ">" . htmlspecialchars($this->body) . "</" . $this->getName() . ">";
        } else {
            $xmlstr .= "<" . $this->getName() . "></" . $this->getName() . ">";
        }
        if ($header === true) {
            $xmlstr = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>" . $xmlstr;
        }
        $xml = new \SimpleXMLElement($xmlstr);
        $this->setAttributes($xml);
        foreach ($this->childs as $child) {
            $child->asChild($xml);
        }

        return $xml->asXML();
    }

    public function __toString()
    {
        return $this->toXML();
    }
}
