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
