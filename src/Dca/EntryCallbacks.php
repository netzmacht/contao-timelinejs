<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Dca;

/**
 * Timeline data container callbacks.
 *
 * @package Netzmacht\TimelineJS
 */
class EntryCallbacks
{
    /**
     * List the row entry.
     *
     * @param array $row Data row.
     *
     * @return string
     */
    public function listEntry($row)
    {
        return $row['startDate'] . ': ' . $row['headline'];
    }
}
