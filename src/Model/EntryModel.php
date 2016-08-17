<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Model;

/**
 * Entry model.
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
