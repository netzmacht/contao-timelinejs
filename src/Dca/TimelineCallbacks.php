<?php

/**
 * @package    Contao TimelineJS.
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\TimelineJs\Dca;

use Netzmacht\Contao\TimelineJs\TimelineProvider;
use Netzmacht\Contao\Toolkit\Dca\Callback\Callbacks;
use Netzmacht\Contao\Toolkit\Dca\Manager;

/**
 * Class TimelineCallbacks.
 *
 * @package Netzmacht\Contao\TimelineJs\Dca
 */
class TimelineCallbacks extends Callbacks
{
    /**
     * Data container name.
     *
     * @var string
     */
    protected static $name = 'tl_timelinejs';

    /**
     * Service name.
     *
     * @var string
     */
    protected static $serviceName = 'timelinejs.dca.timelines';

    /**
     * Set of data sources.
     *
     * @var \ArrayObject
     */
    private $dataSources;

    /**
     * Timeline provider.
     *
     * @var TimelineProvider
     */
    private $timelineProvider;

    /**
     * TimelineCallbacks constructor.
     *
     * @param Manager          $dcaManager       Data container manager.
     * @param \ArrayObject     $dataSources      Data sources.
     * @param TimelineProvider $timelineProvider Timeline provider.
     */
    public function __construct(Manager $dcaManager, \ArrayObject $dataSources, TimelineProvider $timelineProvider)
    {
        parent::__construct($dcaManager);

        $this->dataSources      = $dataSources;
        $this->timelineProvider = $timelineProvider;
    }

    /**
     * Get all data sources.
     *
     * @return array
     */
    public function getDataSources()
    {
        return $this->dataSources->getArrayCopy();
    }

    /**
     * Get all supported languages.
     *
     * @return array
     */
    public function getSupportedLanguages()
    {
        return array_map(
            function ($file) {
                return pathinfo($file, PATHINFO_FILENAME);
            },
            glob(TL_ROOT . '/system/modules/timelinejs/assets/vendor/timelinejs/compiled/js/locale/*.json')
        );
    }

    /**
     * Purge the cache for an updated timeline.
     *
     * @param \DataContainer $dataContainer Data container driver.
     *
     * @return void
     */
    public function purgeCache($dataContainer)
    {
        $model = $this->timelineProvider->getTimelineModel($dataContainer->id);
        $this->timelineProvider->purgeCache($model);
    }
}
