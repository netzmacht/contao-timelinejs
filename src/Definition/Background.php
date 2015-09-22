<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Definition;

use Netzmacht\JavascriptBuilder\Type\ConvertsToJavascript;

/**
 * TimelineJS background value.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition
 */
interface Background extends ConvertsToJavascript
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
