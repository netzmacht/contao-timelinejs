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

use Netzmacht\Contao\TimelineJs\Util\StringUtil;
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
     * {@inheritDoc}
     */
    public function encode(Encoder $encoder, $flags = null)
    {
        $raw  = array_filter(get_object_vars($this));
        $data = array();

        foreach ($raw as $key => $value) {
            $key        = StringUtil::decamelize($key);
            $data[$key] = $value;
        }

        return $encoder->encodeArray($data, $flags);
    }
}
