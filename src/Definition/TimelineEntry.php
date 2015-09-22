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
 * Base class for timeline entries.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition
 */
abstract class TimelineEntry implements ConvertsToJavascript
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
     * Constructor.
     *
     * @param Date $startDate Start date
     * @param Text $text      Slide text.
     * @param Date $endDate   End date.
     */
    public function __construct(
        Date $startDate = null,
        Text $text = null,
        Date $endDate = null
    ) {
        $this->startDate = $startDate;
        $this->text      = $text;
        $this->endDate   = $endDate;
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
