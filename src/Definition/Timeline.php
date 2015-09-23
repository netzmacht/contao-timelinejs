<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Definition;

use Assert\Assertion;
use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Type\ConvertsToJavascript;
use Netzmacht\JavascriptBuilder\Type\HasStackInformation;

/**
 * TimelineJS timeline object.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition
 */
final class Timeline implements ConvertsToJavascript, HasStackInformation
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
     * Options.
     *
     * @var array
     */
    private $options;

    /**
     * Set of eras.
     *
     * @var Era[]
     */
    private $eras;

    /**
     * Timeline constructor.
     *
     * @param Slide[] $events  Set of slides.
     * @param Slide   $title   Title slide.
     * @param string  $scale   The scale.
     * @param array   $options Options.
     * @param array   $eras    Set of eras.
     */
    public function __construct(
        array $events = array(),
        Slide $title = null,
        $scale = null,
        array $options = array(),
        array $eras = array()
    ) {
        $this->setEvents($events);
        $this->setEras($eras);

        $this->title   = $title;
        $this->scale   = $scale;
        $this->options = $options;
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
     * @param Slide[] $events Events.
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
     * Get options.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set options.
     *
     * @param array $options  Options.
     * @param bool  $override If true all options get replaced.
     *
     * @return $this
     */
    public function setOptions(array $options, $override = false)
    {
        if ($override) {
            $this->options = $options;
        } else {
            $this->options = array_merge($this->options, $options);
        }

        return $this;
    }

    /**
     * Set an option.
     *
     * @param string $name  The option name.
     * @param mixed  $value The option value.
     *
     * @return $this
     */
    public function setOption($name, $value)
    {
        $this->options[$name] = $value;

        return $this;
    }

    /**
     * Get an option.
     *
     * @param string $name    Option name.
     * @param mixed  $default Default value.
     *
     * @return mixed
     */
    public function getOption($name, $default = null)
    {
        if (array_key_exists($name, $this->options)) {
            return $this->options[$name];
        }

        return $default;
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
     * @param Era[] $eras Set of eras.
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
    public function encode(Encoder $encoder, $flags = null)
    {
        $data           = $this->options;
        $data['title']  = $this->title;
        $data['events'] = $this->events;
        $data['eras']   = $this->eras;
        $data['scale']  = $this->scale;
        $data           = array_filter($data);

        return $encoder->encodeArray($data, $flags);
    }

    /**
     * {@inheritDoc}
     */
    public function getObjectStack()
    {
        $stack = array_merge($this->events, $this->eras);
        if ($this->title) {
            $stack[] = $this->title;
        }

        return $stack;
    }
}
