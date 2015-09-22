<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
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
