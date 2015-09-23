<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Builder;

use Netzmacht\Contao\TimelineJs\Builder\Event\BuildEntryEvent;
use Netzmacht\Contao\TimelineJs\Builder\Event\BuildTimelineEvent;
use Netzmacht\Contao\TimelineJs\Definition\Timeline;
use Netzmacht\Contao\TimelineJs\Model\EntryModel;
use Netzmacht\Contao\TimelineJs\Model\TimelineModel;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class TimelineBuilder.
 *
 * @package Netzmacht\Contao\TimelineJs\Builder
 */
class TimelineBuilder
{
    /**
     * EventDispatcher.
     *
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * Constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher The event dispatcher.
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Handle the event.
     *
     * @param BuildTimelineEvent $event The event.
     *
     * @return void
     */
    public function handleEvent(BuildTimelineEvent $event)
    {
        $timeline = $event->getTimeline();
        $model    = $event->getModel();

        $this->buildOptions($timeline, $model);
        $this->buildEntries($timeline, $model);
    }

    /**
     * Build timeline options.
     *
     * @param Timeline      $timeline      The timeline.
     * @param TimelineModel $timelineModel The timeline model.
     *
     * @return void
     */
    public function buildOptions(Timeline $timeline, TimelineModel $timelineModel)
    {
        if ($timelineModel->scale != 'human') {
            $timeline->setScale($timelineModel->scale);
        }
    }

    /**
     * Build entries.
     *
     * @param Timeline      $timeline      The timeline.
     * @param TimelineModel $timelineModel The timeline model.
     *
     * @return void
     */
    public function buildEntries(Timeline $timeline, TimelineModel $timelineModel)
    {
        // Only render default data source. Empty for compatibility.
        if ($timelineModel->dataSource != 'default' && $timelineModel->dataSource != '') {
            return;
        }

        $collection = EntryModel::findPublishedByPid($timelineModel->id);

        if ($collection) {
            /** @var EntryModel $model */
            foreach ($collection as $model) {
                $event = new BuildEntryEvent($timelineModel, $model);
                $this->eventDispatcher->dispatch($event::NAME, $event);

                if ($event->getTitle()) {
                    $timeline->setTitle($event->getTitle());
                } elseif ($event->getSlide()) {
                    $timeline->addEvent($event->getSlide());
                }

                if ($event->getEra()) {
                    $timeline->addEra($event->getEra());
                }
            }
        }
    }
}
