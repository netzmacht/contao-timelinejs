<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Util;

/**
 * Class StringUtil.
 *
 * @package Netzmacht\Contao\TimelineJs\Util
 */
class StringUtil
{
    /**
     * Camelize the value.
     *
     * @param string $value The value.
     * @param bool   $first If true first letter get camelized as well.
     *
     * @return string
     */
    public static function camelize($value, $first = false)
    {
        $value = preg_replace_callback(
            '/(^|_)([a-z])/',
            function ($matches) {
                return strtoupper($matches[2]);
            },
            $value
        );

        if ($first) {
            return $value;
        }

        return lcfirst($value);
    }

    /**
     * Decamelize a value.
     *
     * Taken from stackoverflow.com.
     *
     * @param string $value The value.
     *
     * @return string
     * @see    http://stackoverflow.com/a/5194470
     */
    public static function decamelize($value)
    {
        return preg_replace_callback(
            '/(^|[a-z])([A-Z])/',
            function ($matches) {
                return strtolower(strlen($matches[1]) ? $matches[1] . '_' . $matches[2] : $matches[2]);
            },
            $value
        );
    }

    /**
     * Convert a rgb color in hex format into an array.
     *
     * @param string $value Rgb color in hex format. Leading # is optional.
     *
     * @return array|null
     */
    public static function rgbColorToArray($value)
    {
        if (substr($value, 0, 1) === '#') {
            $value = substr($value, 1);
        }

        $length = strlen($value);
        $rgb    = array(
            'r' => null,
            'g' => null,
            'b' => null
        );

        switch ($length) {
            case 3:
                list($rgb['r'], $rgb['g'], $rgb['b']) = str_split($value, 1);
                break;

            case 6:
                list($rgb['r'], $rgb['g'], $rgb['b']) = str_split($value, 2);
                break;

            default:
                return null;
        }

        return $rgb;
    }
}
