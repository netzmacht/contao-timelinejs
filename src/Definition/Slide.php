<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\TimelineJs\Definition;

use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Type\ConvertsToJavascript;

/**
 * TimelineJS slide object.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition
 */
final class Slide implements ConvertsToJavascript
{
    /**
     * The start date.
     *
     * @var Date
     */
    private $startDate;

    /**
     * The end date.
     *
     * @var Date
     */
    private $endDate;

    /**
     * The slide text.
     *
     * @var Text
     */
    private $text;

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
        Date $startDate,
        Text $text = null,
        Date $endDate = null,
        Media $media = null,
        $group = null,
        Background $background = null,
        $dateDisplay = null,
        $autolink = null
    ) {
        $this->startDate   = $startDate;
        $this->text        = $text;
        $this->endDate     = $endDate;
        $this->media       = $media;
        $this->group       = $group;
        $this->background  = $background;
        $this->dateDisplay = $dateDisplay;
        $this->autolink    = $autolink;
    }

    /**
     * Get startDate.
     *
     * @return Date
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set startDate.
     *
     * @param Date $startDate StartDate.
     *
     * @return $this
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get endDate.
     *
     * @return Date
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set endDate.
     *
     * @param Date $endDate EndDate.
     *
     * @return $this
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get text.
     *
     * @return Text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set text.
     *
     * @param Text $text Text.
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
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
    public function setBackground($background)
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
        $this->autolink = $autolink;

        return $this;
    }

    /**
     * Decamelize a value.
     *
     * Taken from stackoverflow.com.
     *
     * @param string $value The value.
     *
     * @return string
     * @see    http://stackoverflow.com/a/5194470
     */
    private function decamelize($value) {
        return preg_replace(
            '/(^|[a-z])([A-Z])/e',
            'strtolower(strlen("\\1") ? "\\1_\\2" : "\\2")',
            $value
        );
    }

    /**
     * {@inheritDoc}
     */
    public function encode(Encoder $encoder, $flags = null)
    {
        $raw  = array_filter(get_object_vars($this));
        $data = array();

        foreach ($raw as $key => $value) {
            $key        = $this->decamelize($key);
            $data[$key] = $value;
        }

        return $encoder->encodeArray($data, $flags);
    }
}