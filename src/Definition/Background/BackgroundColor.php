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

use Netzmacht\Contao\TimelineJs\Definition\Background;

/**
 * Class BackgroundColor.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition\Background
 */
final class BackgroundColor implements Background
{
    /**
     * The background value.
     *
     * @var string
     */
    private $value;

    /**
     * Constructor.
     *
     * @param string $value The background color.
     */
    public function __construct($value)
    {
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
    function jsonSerialize()
    {
        return array('color' => $this->getValue());
    }
}
