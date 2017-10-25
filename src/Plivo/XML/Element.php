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

    /**
     * @param null $body
     * @param array $attributes
     * @return mixed
     */
    function addSpeak($body = null, $attributes = []) {
        return $this->add(new Speak($body, $attributes));
    }

    /**
     * @param null $body
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
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }


    /**
     * @param Element $element
     * @return mixed
     * @throws PlivoXMLException
     */
    protected function add($element) {
        if (!in_array($element->getName(), $this->nestables)) {
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
            $xml->addAttribute($key, $value);
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

        return $xml->asXML();
    }

    /**
     * @return mixed
     */
    public function __toString() {
        return $this->toXML();
    }

}