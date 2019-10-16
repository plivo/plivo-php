<?php

namespace Plivo\XML;


use Plivo\Exceptions\PlivoXMLException;

/**
 * Class Lang
 * @package Plivo\XML
 */
class Lang extends Element {

    protected $nestables = [
        'break',
        'emphasis',
        'lang',
        'p',
        'phoneme',
        'prosody',
        's',
        'say-as',
        'sub',
        'w'
    ];

    protected $valid_attributes = [
        'xmllang'
    ];

    protected $valid_lang_attribute_values = [
        'arb', 'cmn-CN','da-DK','nl-NL','en-AU',
        'en-GB', 'en-IN','en-US','en-GB-WLS',
        'fr-FR', 'fr-CA','de-DE','hi-IN','is-IS',
        'it-IT', 'ja-JP','ko-KR','nb-NO','pl-PL',
        'pt-BR', 'pt-PT','ro-RO','ru-RU','es-ES',
        'es-MX', 'es-US','sv-SE','tr-TR','cy-GB'
    ];

    /**
     * Lang constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {

        if (!$body) {
            throw new PlivoXMLException("No text set for ".$this->getName());
        }
        if(!empty($attributes)){
            foreach ($attributes as $key => $value) {
                if ($key ==='xmllang' && !in_array($value, $this->valid_lang_attribute_values)) {
                    throw new PlivoXMLException(
                        "invalid attribute value ".$value." for ".$key." ".$this->name);
                }
            }
        }

        parent::__construct($body, $attributes);
        $this->name = strtolower($this->name);
    }
}
