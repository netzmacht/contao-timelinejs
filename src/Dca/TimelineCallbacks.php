<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\TimelineJs\Dca;

use Netzmacht\Contao\Toolkit\Dca\Callback\Callbacks;
use Netzmacht\Contao\Toolkit\Dca\Manager;

/**
 * Class TimelineCallbacks
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
     * TimelineCallbacks constructor.
     *
     * @param Manager      $dcaManager
     * @param \ArrayObject $dataSources Data sources.
     */
    public function __construct(Manager $dcaManager, \ArrayObject $dataSources)
    {
        parent::__construct($dcaManager);

        $this->dataSources = $dataSources;
    }


    /**
     * @return array
     */
    public function getDataSources()
    {
        return $this->dataSources->getArrayCopy();
    }

    /**
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
}
