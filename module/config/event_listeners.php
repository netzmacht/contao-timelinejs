<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

use Netzmacht\Contao\TimelineJs\Builder\EntryBuilder;
use Netzmacht\Contao\TimelineJs\Builder\Event\BuildEntryEvent;
use Netzmacht\Contao\TimelineJs\Builder\Event\BuildTimelineOptionsEvent;
use Netzmacht\Contao\TimelineJs\Builder\OptionsBuilder;

return [
    BuildTimelineOptionsEvent::NAME => [
        [new OptionsBuilder(), 'handleEvent']
    ],
    BuildEntryEvent::NAME => [
        [new EntryBuilder(), 'handleEvent']
    ],
];
