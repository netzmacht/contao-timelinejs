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

use DataContainer;
use Netzmacht\Contao\TimelineJs\Model\TimelineModel;
use Netzmacht\Contao\Toolkit\Dca\Button\Callback\StateButtonCallbackFactory;
use Netzmacht\Contao\Toolkit\Dca\Callbacks;
use Netzmacht\Contao\Toolkit\Dca\Callback\ColorPickerCallback;
use Netzmacht\Contao\Toolkit\Dca\Callback\FilePickerCallback;
use Netzmacht\Contao\Toolkit\Dca\Callback\PagePickerCallback;

/**
 * Timeline data container callbacks.
 *
 * @package Netzmacht\TimelineJS
 */
class EntryCallbacks extends Callbacks
{
    use PagePickerCallback;
    use FilePickerCallback;
    use ColorPickerCallback;
    use StateButtonCallbackFactory;

    /**
     * Table name.
     *
     * @var string
     */
    protected static $name = 'tl_timelinejs_entry';

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
