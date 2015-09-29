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

use Netzmacht\Contao\Toolkit\Dca\Callbacks;

class TimelineCallbacks extends Callbacks
{
    public function getDataSources()
    {
        return $this->getServiceContainer()->getService('timelinejs.datasources')->getArrayCopy();
    }

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
