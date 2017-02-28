<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Frontend;

use Netzmacht\Contao\TimelineJs\TimelineProvider;

/**
 * Class JSONController.
 *
 * @package Netzmacht\TimelineJS
 */
class JSONController
{
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
     */
    public function __construct(TimelineProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Generates the json array of a timeline.
     *
     * @param \Input $request Request input.
     *
     * @return void
     * @throws \RuntimeException When no id is given.
     */
    public function execute(\Input $request)
    {
        // Define static urls so insert tag replacements work properly (See #4)
        if (!defined('TL_FILES_URL')) {
            $pageId = $request->get('page');
            $page   = \PageModel::findByPk($pageId);

            \Controller::setStaticUrls($page);
        }

        $timelineId = $request->get('id');
        $model      = $this->provider->getTimelineModel($timelineId);

        header('Content-Type: application/json');
        echo $this->provider->getTimelineJson($model);
    }
}
