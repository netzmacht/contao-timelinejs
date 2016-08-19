<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\FilesystemCache;
use Netzmacht\Contao\TimelineJs\Dca\EntryCallbacks;
use Netzmacht\Contao\TimelineJs\Dca\TimelineCallbacks;
use Netzmacht\Contao\TimelineJs\TimelineProvider;
use Netzmacht\Contao\TimelineJs\Dca\ComponentCallbacks;
use Netzmacht\Contao\Toolkit\DependencyInjection\Services;

global $container;

if (!isset($container['timelinejs.debug-mode'])) {
    $container['timelinejs.debug-mode'] = !$container['toolkit.production-mode'];
}

$container['timelinejs.cache'] = $container->share(
    function ($container) {
        if ($container['timelinejs.debug-mode']) {
            return new ArrayCache();
        } else {
            return new FilesystemCache(TL_ROOT . '/system/cache/timelinejs');
        }
    }
);

$container['timelinejs.provider'] = $container->share(
    function ($container) {
        return new TimelineProvider(
            $container['event-dispatcher'],
            $container['timelinejs.cache']
        );
    }
);

$container['timelinejs.datasources']   = new \ArrayObject();
$container['timelinejs.datasources'][] = 'default';

$container['timelinejs.dca.component-callbacks'] = $container->share(
    function ($container) {
        return new ComponentCallbacks($container[Services::TRANSLATOR]);
    }
);

$container['timelinejs.dca.timelines'] = $container->share(
    function ($container) {
        return new TimelineCallbacks(
            $container[Services::DCA_MANAGER],
            $container['timelinejs.datasources'],
            $container['timelinejs.provider']
        );
    }
);

$container['timelinejs.dca.entries'] = $container->share(
    function ($container) {
        return new EntryCallbacks(
            $container[Services::DCA_MANAGER],
            $container['timelinejs.provider']
        );
    }
);
