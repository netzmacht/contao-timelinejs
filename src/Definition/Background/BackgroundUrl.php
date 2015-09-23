<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Definition\Background;

use Assert\Assertion;
use Netzmacht\Contao\TimelineJs\Definition\Background;

/**
 * Class BackgroundUrl.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition\Background
 */
final class BackgroundUrl implements Background
{
    /**
     * The background value.
     *
     * @var string
     */
    private $value;

    /**
     * BackgroundUrl constructor.
     *
     * @param string $value The background url.
     */
    public function __construct($value)
    {
        Assertion::url($value);

        $this->value = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {
        return 'url';
    }

    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return array('url' => $this->getValue());
    }
}
