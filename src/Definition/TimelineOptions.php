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

/**
 * Class TimelineOptions.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition
 */
class TimelineOptions implements \JsonSerializable
{
    /**
     * Options.
     *
     * @var array
     */
    private $options;

    /**
     * TimelineOptions constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $this->options = $options;
    }

    /**
     * Get options.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set options.
     *
     * @param array $options  Options.
     * @param bool  $override If true all options get replaced.
     *
     * @return $this
     */
    public function setOptions(array $options, $override = false)
    {
        if ($override) {
            $this->options = $options;
        } else {
            $this->options = array_merge($this->options, $options);
        }

        return $this;
    }

    /**
     * Set an option.
     *
     * @param string $name  The option name.
     * @param mixed  $value The option value.
     *
     * @return $this
     */
    public function setOption($name, $value)
    {
        $this->options[$name] = $value;

        return $this;
    }

    /**
     * Get an option.
     *
     * @param string $name    Option name.
     * @param mixed  $default Default value.
     *
     * @return mixed
     */
    public function getOption($name, $default = null)
    {
        if (array_key_exists($name, $this->options)) {
            return $this->options[$name];
        }

        return $default;
    }

    /**
     * Check if an option exists.
     *
     * @param string $name Option name.
     *
     * @return bool
     */
    public function hasOption($name)
    {
        return isset($this->options[$name]);
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return $this->options;
    }
}
