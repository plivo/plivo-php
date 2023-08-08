<?php

namespace Plivo;

/**
 * Class Version
 * @package Plivo
 */
class Version
{
    /**
     * @const string Default api version
     */
    const DEFAULT_API_VERSION = 'v1';

    /**
     * @const int PHP helper library major version number
     */
    const MAJOR = 4;
    /**
     * @const int PHP helper library minor version number
     */
    const MINOR = 54;

    /**
     * @const int PHP helper library patch number
     */
    const PATCH = 0;
    /**
     * @return string
     */
    public function __toString()
    {
        return implode('.', [self::MAJOR, self::MINOR, self::PATCH]);
    }
}
