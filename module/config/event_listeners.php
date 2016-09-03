<?php

/**
 * Contao TimelineJS.
 *
 * @package   Contao TimelineJS.
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */

use Netzmacht\Contao\TimelineJs\Builder\EntryBuilder;
use Netzmacht\Contao\TimelineJs\Builder\Event\BuildEntryEvent;
use Netzmacht\Contao\TimelineJs\Builder\Event\BuildTimelineEvent;
use Netzmacht\Contao\TimelineJs\Builder\Event\BuildTimelineOptionsEvent;
use Netzmacht\Contao\TimelineJs\Builder\OptionsBuilder;
use Netzmacht\Contao\TimelineJs\Builder\TimelineBuilder;
use Netzmacht\Contao\Toolkit\Boot\Event\InitializeSystemEvent;
use Netzmacht\Contao\Toolkit\DependencyInjection\Services;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

return [
    InitializeSystemEvent::NAME => [
        function (InitializeSystemEvent $event) {
            /** @var EventDispatcherInterface $eventDispatcher */
            $eventDispatcher = $event->getContainer()->get(Services::EVENT_DISPATCHER);
            $eventDispatcher->addListener(
                BuildTimelineEvent::NAME,
                [new TimelineBuilder($GLOBALS['container']['event-dispatcher']), 'handleEvent']
            );
        }
    ],
    BuildTimelineOptionsEvent::NAME => [
        [new OptionsBuilder(), 'handleEvent']
    ],
    BuildEntryEvent::NAME => [
        [new EntryBuilder($GLOBALS['container'][Services::INSERT_TAG_REPLACER]), 'handleEvent']
    ],
];
