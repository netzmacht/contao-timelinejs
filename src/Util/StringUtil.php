<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
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
    public static function camelize($value, $first = true)
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
    public static function decamelize($value) {
        return preg_replace_callback(
            '/(^|[a-z])([A-Z])/',
            function ($matches) {
                return strtolower(strlen($matches[1]) ? $matches[1] . '_' . $matches[2] : $matches[2]);
            },
            $value
        );
    }

    /**
     * Replace insert tags with their values
     *
     * @param string  $buffer The text with the tags to be replaced.
     * @param boolean $cache  If false, non-cacheable tags will be replaced.
     *
     * @return string
     */
    public static function replaceInsertTags($buffer, $cache = true)
    {
        return InsertTagReplacer::getInstance()->replace($buffer, $cache);
    }
}
