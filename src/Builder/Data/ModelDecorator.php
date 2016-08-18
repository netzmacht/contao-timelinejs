<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\TimelineJs\Builder\Data;

/**
 * Class ModelDecorator provides array access to an model.
 * 
 * @package Netzmacht\Contao\TimelineJs\Builder\Data
 */
class ModelDecorator implements \ArrayAccess
{
    /**
     * The model.
     * 
     * @var \Model
     */
    private $model;

    /**
     * ModelDecorator constructor.
     *
     * @param \Model $model The model
     */
    public function __construct(\Model $model)
    {
        $this->model = $model;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->model->$offset); 
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {
        return $this->model->$offset;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->model->$offset = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
    {
        $this->model->$offset = null;
    }
}
