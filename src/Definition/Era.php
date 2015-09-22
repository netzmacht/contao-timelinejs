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

/**
 * TimelineJS era object.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition
 */
final class Era extends TimelineEntry
{
    /**
     *  {@inheritDoc}
     */
    public function __construct(Date $startDate, Text $text = null, Date $endDate = null)
    {
        parent::__construct($startDate, $text, $endDate);
    }
}
