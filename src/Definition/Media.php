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

use Assert\Assertion;
use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Type\ConvertsToJavascript;

/**
 * TimelineJS media object.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition
 */
final class Media implements ConvertsToJavascript
{
    /**
     * Media url.
     *
     * @var string
     */
    private $url;

    /**
     * Media caption.
     *
     * @var string
     */
    private $caption;

    /**
     * Media credit information.
     *
     * @var string
     */
    private $credit;

    /**
     * Thumbnail url.
     *
     * @var string
     */
    private $thumbnail;

    /**
     * Media constructor.
     *
     * @param string $url       The media url.
     * @param string $caption   Optional caption.
     * @param string $credit    Optional credit.
     * @param string $thumbnail Optional thumbnail.
     */
    public function __construct($url, $caption = null, $credit = null, $thumbnail = null)
    {
        $this->url       = $url;
        $this->caption   = $caption;
        $this->credit    = $credit;
        $this->thumbnail = $thumbnail;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set url.
     *
     * @param string $url Url.
     *
     * @return $this
     */
    public function setUrl($url)
    {
        Assertion::url($url);

        $this->url = $url;

        return $this;
    }

    /**
     * Get caption.
     *
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set caption.
     *
     * @param string $caption Caption.
     *
     * @return $this
     */
    public function setCaption($caption)
    {
        Assertion::nullOrString($caption);

        $this->caption = $caption;

        return $this;
    }

    /**
     * Get credit.
     *
     * @return string
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set credit.
     *
     * @param string $credit Credit.
     *
     * @return $this
     */
    public function setCredit($credit)
    {
        Assertion::nullOrString($credit);

        $this->credit = $credit;

        return $this;
    }

    /**
     * Get thumbnail.
     *
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set thumbnail.
     *
     * @param string $thumbnail Thumbnail.
     *
     * @return $this
     */
    public function setThumbnail($thumbnail)
    {
        Assertion::nullOrUrl($thumbnail);

        $this->thumbnail = $thumbnail;

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