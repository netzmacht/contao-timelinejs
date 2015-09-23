<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Builder\Event;

use Netzmacht\Contao\TimelineJs\Definition\Era;
use Netzmacht\Contao\TimelineJs\Definition\Slide;
use Netzmacht\Contao\TimelineJs\Model\EntryModel;
use Netzmacht\Contao\TimelineJs\Model\TimelineModel;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class BuildEntryEvent.
 *
 * @package Netzmacht\Contao\TimelineJs\Builder\Event
 */
class BuildEntryEvent extends Event
{
    const NAME = 'timelinejs.builder.build-entry';

    /**
     * The timeline model.
     *
     * @var TimelineModel
     */
    private $timelineModel;

    /**
     * The entry model.
     *
     * @var EntryModel
     */
    private $entryModel;

    /**
     * Event slide.
     *
     * @var Slide
     */
    private $slide;

    /**
     * Event slide.
     *
     * @var Slide
     */
    private $title;

    /**
     * The era.
     * @var Era
     */
    private $era;

    /**
     * BuildEntryEvent constructor.
     *
     * @param TimelineModel $timelineModel The timeline model.
     * @param EntryModel    $entryModel    The entry model.
     */
    public function __construct(TimelineModel $timelineModel, EntryModel $entryModel)
    {
        $this->timelineModel = $timelineModel;
        $this->entryModel    = $entryModel;
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
     * Get entryModel.
     *
     * @return EntryModel
     */
    public function getEntryModel()
    {
        return $this->entryModel;
    }

    /**
     * Get slide.
     *
     * @return Slide|null
     */
    public function getSlide()
    {
        return $this->slide;
    }

    /**
     * Set slide.
     *
     * @param Slide $slide Slide.
     *
     * @return $this
     */
    public function setSlide(Slide $slide)
    {
        $this->slide = $slide;

        return $this;
    }

    /**
     * Get era.
     *
     * @return Era|null
     */
    public function getEra()
    {
        return $this->era;
    }

    /**
     * Set era.
     *
     * @param Era $era Era.
     *
     * @return $this
     */
    public function setEra(Era $era)
    {
        $this->era = $era;

        return $this;
    }

    /**
     * Get title.
     *
     * @return Slide|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param Slide $title Title.
     *
     * @return $this
     */
    public function setTitle(Slide $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Check if the event contains an result.
     *
     * @return bool
     */
    public function hasResult()
    {
        if ($this->getSlide() || $this->getEra() || $this->getTitle()) {
            return true;
        }

        return false;
    }
}
