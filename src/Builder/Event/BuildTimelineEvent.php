<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Builder\Event;

use Netzmacht\Contao\TimelineJs\Definition\Timeline;
use Netzmacht\Contao\TimelineJs\Model\TimelineModel;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class BuildTimelineEvent.
 *
 * @package Netzmacht\Contao\TimelineJs\Builder\Event
 */
class BuildTimelineEvent extends Event
{
    const NAME = 'timelinejs.builder.build-timeline';

    /**
     * Timeline definition.
     *
     * @var Timeline
     */
    private $timeline;

    /**
     * Timeline model.
     *
     * @var TimelineModel
     */
    private $model;

    /**
     * Constructor.
     *
     * @param Timeline      $timeline Timeline definition.
     * @param TimelineModel $model    Timeline model.
     */
    public function __construct(Timeline $timeline, TimelineModel $model)
    {
        $this->timeline = $timeline;
        $this->model    = $model;
    }

    /**
     * Get timeline.
     *
     * @return Timeline
     */
    public function getTimeline()
    {
        return $this->timeline;
    }

    /**
     * Get model.
     *
     * @return TimelineModel
     */
    public function getModel()
    {
        return $this->model;
    }
}
