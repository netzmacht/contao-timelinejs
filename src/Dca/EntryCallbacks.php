<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
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
        return $row['type'] . ': ' . $row['headline'] . ' ' . $row['startDate'];
    }
}
