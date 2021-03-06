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
use Netzmacht\Contao\TimelineJs\Util\StringUtil;

/**
 * TimelineJS media object.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition
 */
final class Media implements \JsonSerializable
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
     * Link.
     *
     * @var string
     */
    private $link;

    /**
     * Link target.
     *
     * @var string
     */
    private $linkTarget;

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
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get link.
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set link.
     *
     * @param string $link   Link.
     * @param null   $target Link target.
     *
     * @return $this
     */
    public function setLink($link, $target = null)
    {
        $this->link       = $link;
        $this->linkTarget = $target;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        $raw  = array_filter(get_object_vars($this));
        $data = array();

        foreach ($raw as $name => $value) {
            $name        = StringUtil::decamelize($name);
            $data[$name] = $value;
        }

        return $data;
    }
}
