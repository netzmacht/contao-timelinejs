<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
 */
namespace Netzmacht\Contao\TimelineJs\Event;

use Netzmacht\Contao\TimelineJs\Model\TimelineModel;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class GetCacheKeyEvent.
 *
 * @package Netzmacht\Contao\TimelineJs\Event
 */
class GetCacheKeyEvent extends Event
{
    const NAME = 'timelinejs.get-cache-key';

    /**
     * The timeline model.
     *
     * @var TimelineModel
     */
    private $timelineModel;

    /**
     * Cache type.
     *
     * @var string
     */
    private $type;

    /**
     * The cache key.
     *
     * @var string
     */
    private $cacheKey;

    /**
     * GetCacheKeyEvent constructor.
     *
     * @param TimelineModel $timelineModel The timeline model.
     * @param string        $type          Type of the cached timeline.
     */
    public function __construct(TimelineModel $timelineModel, $type)
    {
        $this->timelineModel = $timelineModel;
        $this->type          = $type;
        $this->cacheKey      = sprintf('timeline-%s-%s', $timelineModel->id, $type);
    }

    /**
     * Get the timeline model.
     *
     * @return TimelineModel
     */
    public function getTimelineModel()
    {
        return $this->timelineModel;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get cacheKey.
     *
     * @return string
     */
    public function getCacheKey()
    {
        return $this->cacheKey;
    }

    /**
     * Set cacheKey.
     *
     * @param string $cacheKey CacheKey.
     *
     * @return $this
     */
    public function setCacheKey($cacheKey)
    {
        $this->cacheKey = $cacheKey;

        return $this;
    }
}
