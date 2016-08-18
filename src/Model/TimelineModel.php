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
 * Timeline model.
 *
 * @property mixed|null $scale
 * @property mixed|null dataSource
 * @property mixed|null id
 * @property mixed|null thumbnailSize
 */
class TimelineModel extends \Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected static $strTable = 'tl_timelinejs';
}
