<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Model;

/**
 * Entry model.
 *
 * @property mixed|null type
 * @property mixed|null startDate
 * @property mixed|null dateFormat
 * @property mixed|null startDisplay
 * @property mixed|null endDisplay
 * @property mixed|null endDate
 * @property mixed|null category
 * @property mixed|null dateDisplay
 * @property mixed|null autolink
 * @property mixed|null mediaUrl
 * @property mixed|null mediaCaption
 * @property mixed|null mediaCredit
 * @property mixed|null mediaThumbnail
 * @property mixed|null headline
 * @property mixed|null text
 * @property mixed|null background
 * @property mixed|null mediaQuote
 * @property mixed|null mediaLink
 * @property mixed|null media
 */
class EntryModel extends \Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected static $strTable = 'tl_timelinejs_entry';

    /**
     * Find published by parent id.
     *
     * @param int   $pid     The parent id.
     * @param array $options Query options.
     *
     * @return \Model\Collection|null
     */
    public static function findPublishedByPid($pid, array $options = array())
    {
        $table   = static::$strTable;
        $columns = array($table . '.pid=?', $table . '.published=1');

        return static::findBy($columns, $pid, $options);
    }
}
