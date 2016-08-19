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

use Netzmacht\Contao\TimelineJs\Model\TimelineModel;
use Netzmacht\Contao\Toolkit\Dca\Callback\Callbacks;

/**
 * Timeline data container callbacks.
 *
 * @package Netzmacht\TimelineJS
 */
class EntryCallbacks extends Callbacks
{
    /**
     * Table name.
     *
     * @var string
     */
    protected static $name = 'tl_timelinejs_entry';

    /**
     * Service name.
     *
     * @var string
     */
    protected static $serviceName = 'timelinejs.dca.entries';

    /**
     * List the row entry.
     *
     * @param array $row Data row.
     *
     * @return string
     */
    public function listEntry($row)
    {
        return sprintf(
            '%s: %s %s',
            $this->formatValue('type', $row),
            $row['headline'],
            $row['startDate']
        );
    }

    /**
     * Get all category options.
     *
     * @param \DataContainer $dataContainer Data container driver.
     *
     * @return array
     */
    public function getCategoryOptions($dataContainer)
    {
        if ($dataContainer->activeRecord) {
            $timeline = TimelineModel::findByPk($dataContainer->activeRecord->pid);
        } else {
            $timeline = TimelineModel::findByPk(CURRENT_ID);
        }

        return deserialize($timeline->categories, true);
    }
}
