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

/**
 * Base definition class.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition
 */
abstract class Base implements \JsonSerializable
{
    /**
     * Unique object id.
     *
     * @var string
     */
    private $uniqueId;

    /**
     * Get uniqueId.
     *
     * @return string
     */
    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    /**
     * Set uniqueId.
     *
     * @param string $uniqueId UniqueId.
     *
     * @return $this
     */
    public function setUniqueId($uniqueId)
    {
        $this->uniqueId = $uniqueId;

        return $this;
    }
}
