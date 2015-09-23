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

use Netzmacht\JavascriptBuilder\Encoder;

/**
 * TimelineJS slide object.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition
 */
final class Slide extends TimelineEntry
{
    /**
     * The media object.
     *
     * @var Media
     */
    private $media;

    /**
     * Group name.
     *
     * @var string
     */
    private $group;

    /**
     * Optional date display.
     *
     * @var string
     */
    private $dateDisplay;

    /**
     * The background information.
     *
     * @var Background
     */
    private $background;

    /**
     * Autolink urls and emails.
     *
     * @var bool
     */
    private $autolink;

    /**
     * Slide constructor.
     *
     * @param Date       $startDate   Start date
     * @param Text       $text        Slide text.
     * @param Date       $endDate     End date.
     * @param Media      $media       Media object.
     * @param string     $group       Group name.
     * @param Background $background  The background information.
     * @param string     $dateDisplay Optional date display.
     * @param bool       $autolink    Autolink urls and emails.
     */
    public function __construct(
        Date $startDate = null,
        Text $text = null,
        Date $endDate = null,
        Media $media = null,
        $group = null,
        Background $background = null,
        $dateDisplay = null,
        $autolink = null
    ) {
        parent::__construct($startDate, $text, $endDate);

        $this->media       = $media;
        $this->group       = $group;
        $this->background  = $background;
        $this->dateDisplay = $dateDisplay;
        $this->autolink    = $autolink;
    }

    /**
     * Get media.
     *
     * @return Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set media.
     *
     * @param Media $media Media.
     *
     * @return $this
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get group.
     *
     * @return string
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set group.
     *
     * @param string $group Group.
     *
     * @return $this
     */
    public function setGroup($group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get dateDisplay.
     *
     * @return string
     */
    public function getDateDisplay()
    {
        return $this->dateDisplay;
    }

    /**
     * Set dateDisplay.
     *
     * @param string $dateDisplay DateDisplay.
     *
     * @return $this
     */
    public function setDateDisplay($dateDisplay)
    {
        $this->dateDisplay = $dateDisplay;

        return $this;
    }

    /**
     * Get background.
     *
     * @return Background
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * Set background.
     *
     * @param Background $background Background.
     *
     * @return $this
     */
    public function setBackground(Background $background)
    {
        $this->background = $background;

        return $this;
    }

    /**
     * Get autolink.
     *
     * @return boolean
     */
    public function isAutolink()
    {
        return $this->autolink;
    }

    /**
     * Set autolink.
     *
     * @param boolean $autolink Autolink.
     *
     * @return $this
     */
    public function setAutolink($autolink)
    {
        $this->autolink = (bool) $autolink;

        return $this;
    }
}
