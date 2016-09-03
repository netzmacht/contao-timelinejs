<?php

/**
 * @package    Contao TimelineJS.
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\TimelineJs\Event;

use Netzmacht\Contao\TimelineJs\Model\TimelineModel;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class BuildSourceUrl.
 *
 * @package Netzmacht\Contao\TimelineJs\Event
 */
class BuildSourceUrlEvent extends Event
{
    const NAME = 'timelinejs.build-source-url';

    /**
     * Timeline model.
     *
     * @var TimelineModel
     */
    private $timelineModel;

    /**
     * Query parameters.
     *
     * @var \ArrayObject
     */
    private $query;

    /**
     * BuildSourceUrlEvent constructor.
     *
     * @param TimelineModel $timelineModel Timeline model.
     * @param array         $query         Query params.
     */
    public function __construct(TimelineModel $timelineModel, array $query = array())
    {
        $this->timelineModel = $timelineModel;
        $this->query         = new \ArrayObject($query);
    }

    /**
     * Get timeline model.
     *
     * @return TimelineModel
     */
    public function getTimelineModel()
    {
        return $this->timelineModel;
    }

    /**
     * Get query.
     *
     * @return \ArrayObject
     */
    public function getQuery()
    {
        return $this->query;
    }
}
