<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
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
     *
     * @return string
     */
    public static function camelize($value)
    {
        return preg_replace('/(^|_)([a-z])/', 'strtoupper("\\2")', $value);
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
        return preg_replace(
            '/(^|[a-z])([A-Z])/e',
            'strtolower(strlen("\\1") ? "\\1_\\2" : "\\2")',
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
        if (version_compare(VERSION, '3.5', '>=')) {
            return \Controller::replaceInsertTags($buffer, $cache);
        } else {
            $reflector = new \ReflectionClass('Contao\Controller');
            $instance  = $reflector->newInstanceWithoutConstructor();

            $method = $reflector->getMethod('replaceInsertTags');
            $method->setAccessible(true);

            return $method->invoke($instance, $buffer, $cache);
        }
    }
}
