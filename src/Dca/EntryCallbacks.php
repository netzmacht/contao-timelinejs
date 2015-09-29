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

use DataContainer;
use Input;
use Netzmacht\Contao\TimelineJs\Model\TimelineModel;
use Netzmacht\Contao\Toolkit\Dca\Callbacks;

/**
 * Timeline data container callbacks.
 *
 * @package Netzmacht\TimelineJS
 */
class EntryCallbacks extends Callbacks
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
        $key = sprintf('types.%s.0', $row['type']);

        return sprintf(
            '%s: %s %s',
            $this->translate($key, 'tl_timelinejs_entry'),
            $row['headline'],
            $row['startDate']
        );
    }

    public function getCategoryOptions($dataContainer)
    {
        if ($dataContainer->activeRecord) {
            $timeline = TimelineModel::findByPk($dataContainer->activeRecord->pid);
        } else {
            $timeline = TimelineModel::findByPk(CURRENT_ID);
        }

        return deserialize($timeline->categories, true);
    }

    /**
     * Return the file picker wizard.
     *
     * @param \DataContainer
     * @return string
     */
    public function filePicker(DataContainer $dc)
    {
        return ' <a href="contao/file.php?do=' . Input::get(
            'do'
        ) . '&amp;table=' . $dc->table . '&amp;field=' . $dc->field . '&amp;value=' . $dc->value . '" title="' . specialchars(
            str_replace("'", "\\'", $GLOBALS['TL_LANG']['MSC']['filepicker'])
        ) . '" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':768,\'title\':\'' . specialchars(
            $GLOBALS['TL_LANG']['MOD']['files'][0]
        ) . '\',\'url\':this.href,\'id\':\'' . $dc->field . '\',\'tag\':\'ctrl_' . $dc->field . ((Input::get(
                'act'
            ) == 'editAll') ? '_' . $dc->id : '') . '\',\'self\':this});return false">' . \Image::getHtml(
            'pickfile.gif',
            $GLOBALS['TL_LANG']['MSC']['filepicker'],
            'style="vertical-align:top;cursor:pointer"'
        ) . '</a>';
    }

    /**
     * Return the page picker wizard.
     *
     * @param \DataContainer
     * @return string
     */
    public function pagePicker(DataContainer $dc)
    {
        return ' <a href="contao/page.php?do=' . Input::get(
            'do'
        ) . '&amp;table=' . $dc->table . '&amp;field=' . $dc->field . '&amp;value=' . str_replace(
            array('{{link_url::', '}}'),
            '',
            $dc->value
        ) . '" title="' . specialchars(
            $GLOBALS['TL_LANG']['MSC']['pagepicker']
        ) . '" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':768,\'title\':\'' . specialchars(
            str_replace("'", "\\'", $GLOBALS['TL_LANG']['MOD']['page'][0])
        ) . '\',\'url\':this.href,\'id\':\'' . $dc->field . '\',\'tag\':\'ctrl_' . $dc->field . ((Input::get(
                'act'
            ) == 'editAll') ? '_' . $dc->id : '') . '\',\'self\':this});return false">' . \Image::getHtml(
            'pickpage.gif',
            $GLOBALS['TL_LANG']['MSC']['pagepicker'],
            'style="vertical-align:top;cursor:pointer"'
        ) . '</a>';
    }
}
