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

/**
 * TimelineJS text object.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition
 */
final class Text implements \JsonSerializable
{
    /**
     * The text.
     *
     * @var string
     */
    private $text;

    /**
     * The headline.
     *
     * @var string
     */
    private $headline;

    /**
     * Text constructor.
     *
     * @param string $headline The headline.
     * @param string $text     The text.
     */
    public function __construct($headline = null, $text = null)
    {
        $this->headline = $headline;
        $this->text     = $text;
    }

    /**
     * Get text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set text.
     *
     * @param string $text Text.
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get headline.
     *
     * @return string
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set headline.
     *
     * @param string $headline Headline.
     *
     * @return $this
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
