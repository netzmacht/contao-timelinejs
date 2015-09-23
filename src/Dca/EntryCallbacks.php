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

    /**
     * Return the file picker wizard
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
}
