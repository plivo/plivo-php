<?php

namespace Plivo\Util;


/**
 * Class ArrayOperations
 * @package Plivo\Util
 */
class ArrayOperations
{
    /**
     * Return an array without keys with null values
     *
     * @param array $array
     * @return array
     */
    public static function removeNull(array $array)
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_null($value)) {
                continue;
            }
            $result[$key] = $value;
        }
        return $result;
    }

    /**
     * Returns true if no null value present otherwise false
     *
     * @param array $array
     * @return bool
     */
    public static function checkNull(array $array)
    {
        foreach ($array as $value) {
            if (is_null($value)) {
                return true;
            }
        }
        return false;
    }

}