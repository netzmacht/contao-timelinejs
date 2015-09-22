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
 * TimelineJS text object.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition
 */
final class Text implements ConvertsToJavascript
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
    public function encode(Encoder $encoder, $flags = null)
    {
        $data = array_filter(get_object_vars($this));

        return $encoder->encodeArray($data, $flags);
    }
}