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

use Netzmacht\Contao\TimelineJs\Definition\TimelineOptions;
use Netzmacht\Contao\TimelineJs\Model\TimelineModel;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class BuildTimelineOptionsEvent.
 *
 * @package Netzmacht\Contao\TimelineJs\Builder\Event
 */
class BuildTimelineOptionsEvent extends Event
{
    const NAME = 'timelinejs.builder.build-options';

    /**
     * Timeline model.
     *
     * @var TimelineModel
     */
    private $timelineModel;

    /**
     * Timeline options.
     *
     * @var TimelineOptions
     */
    private $options;

    /**
     * BuildTimelineOptionsEvent constructor.
     *
     * @param TimelineModel   $timelineModel Timeline model.
     * @param TimelineOptions $options       Options object.
     */
    public function __construct(TimelineModel $timelineModel, TimelineOptions $options = null)
    {
        $this->timelineModel = $timelineModel;
        $this->options       = $options ?: new TimelineOptions();
    }

    /**
     * Get timelineModel.
     *
     * @return TimelineModel
     */
    public function getTimelineModel()
    {
        return $this->timelineModel;
    }

    /**
     * Get options.
     *
     * @return TimelineOptions
     */
    public function getOptions()
    {
        return $this->options;
    }
}
