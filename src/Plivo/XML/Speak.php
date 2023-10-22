<?php

namespace Plivo\XML;

use Plivo\Exceptions\PlivoXMLException;


/**
 * Class Speak
 * @package Plivo\XML
 */
class Speak extends Element {
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
        'w',
        'cont'
    ];

    protected $valid_attributes = ['voice', 'language', 'loop'];

    protected $valid_voice_attribute_values = [
        'man',
        'woman',
        'MAN',
        'WOMAN',
        'Polly.Zeina', 'Polly.Zhiyu','Polly.Naja','Polly.Mads','Polly.Lotte',
        'Polly.Ruben','Polly.Nicole','Polly.Russell','Polly.Amy',
        'Polly.Emma','Polly.Brian','Polly.Aditi','Polly.Raveena',
        'Polly.Ivy','Polly.Joanna','Polly.Kendra','Polly.Kimberly',
        'Polly.Salli','Polly.Joey','Polly.Justin','Polly.Matthew',
        'Polly.Geraint','Polly.Céline','Polly.Celine','Polly.Mathieu',
        'Polly.Chantal','Polly.Marlene','Polly.Vicki','Polly.Hans',
        'Polly.Dóra','Polly.Dora','Polly.Karl','Polly.Carla',
        'Polly.Bianca','Polly.Giorgio','Polly.Mizuki','Polly.Takumi',
        'Polly.Seoyeon','Polly.Liv','Polly.Ewa','Polly.Maja','Polly.Jacek',
        'Polly.Jan','Polly.Vitória','Polly.Vitoria','Polly.Ricardo',
        'Polly.Inês','Polly.Ines','Polly.Cristiano','Polly.Carmen',
        'Polly.Tatyana','Polly.Maxim','Polly.Conchita','Polly.Lucia',
        'Polly.Enrique','Polly.Mia','Polly.Penélope','Polly.Penelope',
        'Polly.Miguel','Polly.Astrid','Polly.Filiz','Polly.Gwyneth'
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
     * Speak constructor.
     * @param string $body
     * @param array $attributes
     * @throws PlivoXMLException
     */
    function __construct($body, $attributes = []) {
        if (!$body) {
            throw new PlivoXMLException("No text set for ".$this->getName());
        } else if(strlen($body)>3000) {
            throw new PlivoXMLException("Exceeds the maximum limit of 3000 characters! ".$this->getName());
        }
        if(empty($attributes)){
            $attributes = array('voice'=>'woman');
        } else {
            foreach ($attributes as $key => $value) {
                if ($key ==='voice' && !in_array($value, $this->valid_voice_attribute_values)) {
                    throw new PlivoXMLException(
                        "invalid attribute value ".$value." for ".$key." ".$this->name);
                }
                if ($key ==='language' && !in_array($value, $this->valid_lang_attribute_values)) {
                    throw new PlivoXMLException(
                        "invalid attribute value ".$value." for ".$key." ".$this->name);
                }
            }
            if(!array_key_exists("voice",$attributes)){
                $attributes['voice'] = 'woman';
            }
        }
        parent::__construct($body, $attributes);
    }
}
