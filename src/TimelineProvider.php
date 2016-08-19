<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

namespace Netzmacht\Contao\TimelineJs;

use Doctrine\Common\Cache\Cache;
use Netzmacht\Contao\TimelineJs\Builder\Event\BuildTimelineEvent;
use Netzmacht\Contao\TimelineJs\Builder\Event\BuildTimelineOptionsEvent;
use Netzmacht\Contao\TimelineJs\Definition\Timeline;
use Netzmacht\Contao\TimelineJs\Definition\TimelineOptions;
use Netzmacht\Contao\TimelineJs\Event\GetCacheKeyEvent;
use Netzmacht\Contao\TimelineJs\Model\TimelineModel;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Class TimelineProvider
 *
 * @package Netzmacht\Contao\TimelineJs
 */
class TimelineProvider
{
    /**
     * Event dispatcher.
     *
     * @var EventDispatcher
     */
    private $eventDispatcher;

    /**
     * The cache.
     *
     * @var Cache
     */
    private $cache;

    /**
     * TimelineProvider constructor.
     *
     * @param EventDispatcher $eventDispatcher Event dispatcher.
     * @param Cache           $cache           The cache.
     */
    public function __construct(EventDispatcher $eventDispatcher, Cache $cache)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->cache           = $cache;
    }

    /**
     * Get the timeline model.
     *
     * @param int $timelineId The timeline id.
     *
     * @return TimelineModel
     */
    public function getTimelineModel($timelineId)
    {
        $model = TimelineModel::findByPk($timelineId);

        if (!$model) {
            throw new \InvalidArgumentException(sprintf('Timeline "%s" does not exists.', $timelineId));
        }

        return $model;
    }

    /**
     * Get a timeline.
     *
     * @param TimelineModel $model The timeline model.
     *
     * @return Timeline
     */
    public function getTimeline(TimelineModel $model)
    {
        $cacheKey = $this->getCacheKey($model, 'definition');
        if ($this->cache->contains($cacheKey)) {
            return $this->cache->fetch($cacheKey);
        }

        $timeline = new Timeline();
        $event    = new BuildTimelineEvent($timeline, $model);

        $this->eventDispatcher->dispatch($event::NAME, $event);
        $this->cache->save($cacheKey, $timeline);

        return $timeline;
    }

    /**
     * Get the json for a timeline.
     *
     * @param TimelineModel $model The timeline model.
     *
     * @return string
     */
    public function getTimelineJson(TimelineModel $model)
    {
        $cacheKey = $this->getCacheKey($model, 'json');

        if ($this->cache->contains($cacheKey)) {
            return $this->cache->fetch($cacheKey);
        }

        $timeline = $this->getTimeline($model);
        $json     = json_encode($timeline);
        $this->cache->save($cacheKey, $json);

        return $json;
    }

    /**
     * Get the timeline options.
     *
     * @param TimelineModel $model The timeline model.
     *
     * @return TimelineOptions
     */
    public function getOptions(TimelineModel $model)
    {
        $cacheKey = $this->getCacheKey($model, 'options');
        if ($this->cache->contains($cacheKey)) {
            return $this->cache->fetch($cacheKey);
        }
        
        $event = new BuildTimelineOptionsEvent($model);
        $this->eventDispatcher->dispatch($event::NAME, $event);
        $options = $event->getOptions();
        
        $this->cache->save($cacheKey, $options);
        
        return $options;
    }

    /**
     * Get the json for a timeline options.
     *
     * @param TimelineModel $model The timeline model.
     *
     * @return string
     */
    public function getOptionsJson(TimelineModel $model)
    {
        $cacheKey = $this->getCacheKey($model, 'options-json');
        if ($this->cache->contains($cacheKey)) {
            return $this->cache->fetch($cacheKey);
        }

        $options = $this->getOptions($model);
        $json    = json_encode($options);

        $this->cache->save($cacheKey, $json);

        return $json;
    }

    /**
     * Purge the cache for a timeline.
     *
     * @param TimelineModel $model The timeline model.
     *
     * @return void
     */
    public function purgeCache(TimelineModel $model)
    {
        foreach (['definition', 'json', 'options', 'options-json'] as $type) {
            $cacheKey = $this->getCacheKey($model, $type);
            $this->cache->delete($cacheKey);
        }
    }

    /**
     * Get the cache key for an object.
     *
     * @param TimelineModel $timelineModel The timeline model.
     * @param string        $type          Cache type.
     *
     * @return string
     */
    protected function getCacheKey(TimelineModel $timelineModel, $type)
    {
        $event = new GetCacheKeyEvent($timelineModel, $type);
        $this->eventDispatcher->dispatch($event::NAME, $event);

        return $event->getCacheKey();
    }
}
