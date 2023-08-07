<?php

namespace Plivo\Util;
use Plivo\Exceptions\PlivoValidationException;

function validateNotNullAndDataType($value, $className, $propertyName, $dataType, $checkNull=false)
{
    if (is_null($value) && $checkNull) {
        throw new PlivoValidationException("Property '$propertyName' of '$className' data_type is mandatory.");
    }
    if (!is_null($value) && gettype($value) !== $dataType) {
        throw new PlivoValidationException("Property '$propertyName' of '$className' data_type should be of type '$dataType'.");
    }
}

class Currency {
    public $fallback_value;
    public $currency_code;
    public $amount_1000;

    public function __construct(array $data)
    {
        // Validate the data
        $this->fallback_value = isset($data['fallback_value'])  ? $data['fallback_value'] : null;
        $this->currency_code = isset($data['currency_code']) ? $data['currency_code'] : null;
        $this->amount_1000 = isset($data['amount_1000']) ? $data['amount_1000'] : null;

        validateNotNullAndDataType($this->fallback_value, 'currency', 'fallback_value', 'string', true);
        validateNotNullAndDataType($this->currency_code, 'currency', 'currency_code', 'string', true);
        validateNotNullAndDataType($this->amount_1000, 'currency', 'amount_1000', 'integer', true);
    }


}

class DateTime {
    public $fallback_value;

    public function __construct(array $data)
    {
        // Validate the data
        $this->fallback_value = isset($data['fallback_value'])? $data['fallback_value'] : null;
        validateNotNullAndDataType($this->fallback_value, 'date_time', 'fallback_value', 'string', true);
    }
    
}

class Parameter {
    public $type;
    public $text;
    public $media;
    public $currency;
    public $date_time;

    public function __construct(array $data)
    {
        // Validate the data
        $this->type = isset($data['type'])? $data['type'] : null;
        $this->text = isset($data['text'])? $data['text'] : null;
        $this->media = isset($data['media'])? $data['media'] : null;
        $this->currency = isset($data['currency'])? new Currency($data['currency']) : null;
        $this->date_time = isset($data['date_time']) ? new DateTime($data['date_time']) : null;
        validateNotNullAndDataType($this->type, 'parameter', 'type', 'string', true);
        validateNotNullAndDataType($this->text, 'parameter', 'text', 'string');
        validateNotNullAndDataType($this->media, 'parameter', 'media', 'string');
    }
    

}

class Component {
    public $type;
    public $sub_type;
    public $index;
    public $parameters;

    public function __construct(array $data)
    {
        // Validate the data
        $this->type = isset($data['type'])? $data['type'] : null;
        $this->sub_type = isset($data['sub_type'])? $data['sub_type'] : null;
        $this->index = isset($data['index']) ? $data['index'] : null;
        $this->parameters = isset($data['parameters']) ? array_map(function($param) {return new Parameter($param);}, $data['parameters']): [];
        validateNotNullAndDataType($this->type, 'component', 'type', 'string', true);
        validateNotNullAndDataType($this->sub_type, 'component', 'sub_type', 'string');
        validateNotNullAndDataType($this->index, 'component', 'index', 'string');
    }
    
}

class Template {
    public $name;
    public $language;
    public $components;

    public function __construct(array $data)
    {
        // Validate the data
        $this->name = isset($data['name'])? $data['name'] : null;
        $this->language = isset($data['language'])? $data['language'] : null;
        $this->components = isset($data['components']) ? array_map(function($component) {return new Component($component);}, $data['components']): [];
        validateNotNullAndDataType($this->name, 'template', 'name','string', true);
        validateNotNullAndDataType($this->language, 'template', 'language', 'string', true);
    }


    public static function validateTemplate(string $template)
    {
        try {
            if(is_null(json_decode($template, true)))
            {
                return "Invalid JSON data for template!";
            }
            //Validate the JSON data against the Template class
            $template = new Template(json_decode($template, true));
            return null;
    } catch (PlivoValidationException $e) {
        // Handle validation errors here
        return $e->getMessage();
        }
    }
}
