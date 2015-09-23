<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Frontend;

use Netzmacht\Contao\TimelineJs\TimelineProvider;

/**
 * Class JSONController.
 *
 * @package Netzmacht\TimelineJS
 */
class JSONController extends \Frontend
{
    /**
     * The input.
     *
     * @var \Input
     */
    private $input;

    /**
     * Timeline provider.
     *
     * @var TimelineProvider
     */
    private $provider;

    /**
     * Construct.
     *
     * @param TimelineProvider $provider Timeline provider.
     * @param \Input           $input    The input.
     */
    public function __construct(TimelineProvider $provider, \Input $input)
    {
        parent::__construct();

        $this->input    = $input;
        $this->provider = $provider;
    }

    /**
     * Generates the json array of a timeline.
     *
     * @return void
     * @throws \RuntimeException When no id is given.
     */
    public function run()
    {
        $timelineId = $this->input->get('id');
        $model      = $this->provider->getTimelineModel($timelineId);

        header('Content-Type: application/json');
        echo $this->provider->getTimelineJson($model);
    }
}
