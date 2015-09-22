<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\TimelineJs\Definition\Background;

use Assert\Assertion;
use Netzmacht\Contao\TimelineJs\Definition\Background;
use Netzmacht\JavascriptBuilder\Encoder;

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
    public function encode(Encoder $encoder, $flags = null)
    {
        $data = array('color' => $this->getValue());

        return $encoder->encodeArray($data, $flags);
    }
}
