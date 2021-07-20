<?php

namespace Plivo\Util;

use phpDocumentor\Reflection\Types\Integer;
use Plivo\Exceptions\PlivoValidationException;

class MPCUtils{
    public static function validSubAccount($accountId){
        if(is_string($accountId)) {
            throw new PlivoValidationException('Subaccount Id must be a string');
        }
        if(strlen($accountId) != 20) {
            throw new PlivoValidationException('Subaccount Id should be of length 20');
        }
        if(substr($accountId, 0, 2) != 'SA'){
            throw new PlivoValidationException('Subaccount Id should start with "SA"');
        }
    }

    public static function validMultipleDestinationNos($paramName, $paramValue, $optionalArgs = []){
        if(count(explode($optionalArgs['delimiter'],$paramValue))>1 && strtolower($optionalArgs['role'])!='agent'){
            throw new PlivoValidationException('Multiple ' . $paramName . ' values given for role ' . $optionalArgs['role']);
        }
        elseif(count(explode($optionalArgs['delimiter'],$paramValue)) >= $optionalArgs['agentLimit']){
            throw new PlivoValidationException('No of ' . $paramName . ' values provided should be lesser than ' . $optionalArgs['agentLimit']);
        }
        else{
            return true;
        }
    }

    public static function validMultipleDestinationIntegers($paramName, $paramValue){
        $values = explode("<",$paramValue);
        for ($i=0;$i<sizeof($values);$i++)
        {
            if((!is_numeric($values[$i]) || is_double(1*$values[$i]))){
                throw new PlivoValidationException($paramName. ' Destination Values must be integers');
            }
        }
    }

    public static function validParam($paramName, $paramValue, $expectedTypes = null, $mandatory = false, $expectedValues = null){
        if($mandatory and !$paramValue){
            throw new PlivoValidationException($paramName . " is a required parameter");
        }
        if(!$paramValue){
            return true;
        }
        if(!$expectedValues){
            return self::expectedType($paramName, $expectedTypes, $paramValue);
        }
        if(self::expectedValue($paramName, $expectedValues, $paramValue)){
            return true;
        }
        return true;
    }

    public static function expectedType($paramName, $expectedTypes, $paramValue){
        if(!$expectedTypes){
            return true;
        }
        if(!in_array(gettype($paramValue), $expectedTypes)){
            throw new PlivoValidationException($paramName . ": Expected one of " . implode(" ",$expectedTypes) . " but received " . gettype($paramValue) . " instead");
        }
        return true;
    }

    public static function expectedValue($paramName, $expectedValues, $paramValue){
        if(!$expectedValues){
            return true;
        }
        if(is_array($expectedValues)){
            if(!in_array($paramValue, $expectedValues)){
                throw new PlivoValidationException($paramName . ': Expected one of ' . implode(" ",$expectedValues) . ' but received ' . $paramValue . ' instead');
            }
            return true;
        }
        else{
            if($expectedValues != $paramValue){
                throw new PlivoValidationException($paramName . ': Expected ' . $expectedValues . ' but received ' . $paramValue . ' instead');
            }
            return true;
        }
    }

    public static function multiValidParam($paramName, $paramValue, $expectedTypes = null, $mandatory = false, $expectedValues = null, $makeLowerCase = false, $seperator = ','){
        if($mandatory and !$paramValue){
            throw new PlivoValidationException($paramName . 'is a required parameter');
        }
        if(!$paramValue){
            return true;
        }
        if($makeLowerCase){
            $paramValue = strtolower($paramValue);
        }
        else{
            $paramValue = strtolower($paramValue);
        }
        $values = explode($seperator, $paramValue);
        if($expectedValues){
            for($i = 0; $i < count($values); $i++){
                self::expectedValue($paramName, $expectedValues, trim($values[$i]));
            }
        }
        return true;
    }

    public static function validUrl($paramName, $paramValue, $mandatory = false){
        if($mandatory && !$paramValue){
            throw new PlivoValidationException($paramName . 'is a required parameter');
        }
        if(!$paramValue){
            return true;
        }
        if(!filter_var($paramValue, FILTER_VALIDATE_URL)){
            throw new PlivoValidationException("Invalid URL : Doesn't satisfy the URL format");
        }
        else{
            return true;
        }
    }

    public static function isOneAmongStringUrl($paramName, $paramValue, $mandatory = false, $expectedValues = null){
        if($mandatory && !$paramValue){
            throw new PlivoValidationException($paramName . 'is a required parameter');
        }
        if(!$paramValue){
            return true;
        }
        if(in_array(strtolower($paramValue),$expectedValues) || in_array(strtoupper($paramValue),$expectedValues)){
            return true;
        }
        elseif (self::validUrl($paramName, $paramValue)){
            return true;
        }
        else{
            throw new PlivoValidationException($paramName . ' neither a valid URL nor in the expected values');
        }
    }

    public static function validDateFormat($paramName, $paramValue, $mandatory = false){
        if($mandatory && !$paramValue){
            throw new PlivoValidationException($paramName . 'is a required parameter');
        }
        if(!$paramValue){
            return true;
        }
        if(!preg_match('/^(\d{4}\-\d{2}\-\d{2}\ \d{2}\:\d{2}(\:\d{2}(\.\d{1,6})?)?)$/ix', $paramValue)){
            throw new PlivoValidationException("Invalid Date : Doesn't satisfy the date format");
        }
        else{
            return true;
        }
    }

    public static function validRange($paramName, $paramValue, $mandatory = false, $lowerBound = null, $upperBound = null){
        if($mandatory and !$paramValue){
            throw new PlivoValidationException($paramName . " is a required parameter");
        }
        if(!isset($paramValue)){
            return true;
        }
        if(!self::expectedType($paramName, ['integer'], $paramValue)){
            throw new PlivoValidationException($paramName . ": Expected an Integer but received " . gettype($paramValue) . " instead");
        }
        if(!is_null($lowerBound) and !is_null($upperBound)){
            if($paramValue < $lowerBound || $paramValue > $upperBound){
                throw new PlivoValidationException($paramName . " ranges between " . $lowerBound . " and " . $upperBound);
            }
            if($paramValue >= $lowerBound && $paramValue <= $upperBound){
                return true;
            }
        }
        elseif (!is_null($lowerBound)){
            if($paramValue < $lowerBound){
                throw new PlivoValidationException($paramName . " should be greater than " . $lowerBound);
            }
            if($paramValue >= $lowerBound){
                return true;
            }
        }
        elseif(!is_null($upperBound)){
            if($paramValue > $upperBound){
                throw new PlivoValidationException($paramName . " should be lesser than " . $upperBound);
            }
            if($paramValue <= $upperBound){
                return true;
            }
        }
        else{
            throw new PlivoValidationException("Any one or both of lower and upper bound should be provided");
        }
        return true;
    }
}