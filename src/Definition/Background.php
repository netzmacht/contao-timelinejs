<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Definition;

/**
 * TimelineJS background value.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition
 */
interface Background extends \JsonSerializable
{
    /**
     * Get background type.
     *
     * @return string
     */
    public function getType();

    /**
     * Get background value.
     *
     * @return string
     */
    public function getValue();
}
