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
        return array_filter($array);
    }

    /**
     * Returns true if no null value present otherwise false
     *
     * @param array $array
     * @return bool
     */
    public static function checkNull(array $array)
    {
        return !in_array(null, $array, true);
    }

}
