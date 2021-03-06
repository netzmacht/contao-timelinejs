<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Definition;

use Assert\Assertion;

/**
 * TimelineJS timeline object.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition
 */
final class Timeline extends Base
{
    const SCALE_HUMAN        = 'human';
    const SCALE_COSMOLOGICAL = 'cosmological';

    /**
     * Set of slides.
     *
     * @var Slide[]
     */
    private $events;

    /**
     * Title slide.
     *
     * @var Slide
     */
    private $title;

    /**
     * The scale.
     *
     * @var string
     */
    private $scale;

    /**
     * Set of eras.
     *
     * @var Era[]
     */
    private $eras;

    /**
     * Timeline constructor.
     *
     * @param array|Slide[] $events Set of slides.
     * @param Slide         $title  Title slide.
     * @param string        $scale  The scale.
     * @param array         $eras   Set of eras.
     */
    public function __construct(
        array $events = array(),
        Slide $title = null,
        $scale = null,
        array $eras = array()
    ) {
        $this->setEvents($events);
        $this->setEras($eras);

        $this->title = $title;
        $this->scale = $scale;
    }

    /**
     * Get title.
     *
     * @return Slide
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
     * Get scale.
     *
     * @return string
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * Set scale.
     *
     * @param string $scale Scale.
     *
     * @return $this
     */
    public function setScale($scale)
    {
        $this->scale = $scale;

        return $this;
    }

    /**
     * Get events.
     *
     * @return Slide[]
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Set events.
     *
     * @param Slide[]|array $events Events.
     *
     * @return $this
     */
    public function setEvents(array $events)
    {
        Assertion::allIsInstanceOf($events, 'Netzmacht\Contao\TimelineJs\Definition\Slide');

        $this->events = $events;

        return $this;
    }

    /**
     * Add an event.
     *
     * @param Slide $slide The event slide.
     *
     * @return $this
     */
    public function addEvent(Slide $slide)
    {
        Assertion::isInstanceOf(
            $slide->getStartDate(),
            'Netzmacht\Contao\TimelineJs\Definition\Date',
            'Start date is required.'
        );

        $this->events[] = $slide;

        return $this;
    }

    /**
     * Get era.
     *
     * @return Era[]
     */
    public function getEras()
    {
        return $this->eras;
    }

    /**
     * Set era.
     *
     * @param Era[]|array $eras Set of eras.
     *
     * @return $this
     */
    public function setEras(array $eras)
    {
        Assertion::allIsInstanceOf($eras, 'Netzmacht\Contao\TimelineJs\Definition\Slide');

        $this->eras = $eras;

        return $this;
    }

    /**
     * Add an era.
     *
     * @param Era $era The era.
     *
     * @return $this
     */
    public function addEra(Era $era)
    {
        $this->eras[] = $era;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        $data = array(
            'unique_id' => $this->getUniqueId(),
            'title'     => $this->title,
            'events'    => $this->events,
            'eras'      => $this->eras,
            'scale'     => $this->scale
        );

        return array_filter($data);
    }
}
