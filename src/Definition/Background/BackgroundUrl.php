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
use Netzmacht\JavascriptBuilder\Encoder;

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
    public function encode(Encoder $encoder, $flags = null)
    {
        $data = array('url' => $this->getValue());

        return $encoder->encodeArray($data, $flags);
    }
}
