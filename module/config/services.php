<?php

/**
 * Contao TimelineJS.
 *
 * @package   Contao TimelineJS.
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\FilesystemCache;
use Netzmacht\Contao\TimelineJs\Dca\EntryCallbacks;
use Netzmacht\Contao\TimelineJs\Dca\TimelineCallbacks;
use Netzmacht\Contao\TimelineJs\DependencyInjection\TimelineServices;
use Netzmacht\Contao\TimelineJs\TimelineProvider;
use Netzmacht\Contao\TimelineJs\Dca\ComponentCallbacks;
use Netzmacht\Contao\Toolkit\DependencyInjection\Services;

global $container;

if (!isset($container[TimelineServices::DEBUG_MODE])) {
    $container[TimelineServices::DEBUG_MODE] = true; // !$container[Services::PRODUCTION_MODE];
}

/**
 * Timeline cache dir.
 *
 * @var string
 */
$container[TimelineServices::CACHE_DIR] = '/system/cache/timelinejs';

/**
 * Internal used timeline cache.
 *
 * @var Cache
 */
$container[TimelineServices::CACHE] = $container->share(
    function ($container) {
        if ($container[TimelineServices::DEBUG_MODE]) {
            return new ArrayCache();
        } else {
            return new FilesystemCache(TL_ROOT . $container[TimelineServices::CACHE_DIR]);
        }
    }
);

/**
 * Timeline provider.
 *
 * @var TimelineProvider
 */
$container[TimelineServices::TIMELINE_PROVIDER] = $container->share(
    function ($container) {
        return new TimelineProvider(
            $container[Services::EVENT_DISPATCHER],
            $container[TimelineServices::CACHE]
        );
    }
);

/**
 * Data sources.
 *
 * @var \ArrayObject
 */
if (!isset($container[TimelineServices::DATA_SOURCES])) {
    $container[TimelineServices::DATA_SOURCES] = new \ArrayObject();
}

/**
 * Default data source.
 *
 * @var string
 */
$container[TimelineServices::DATA_SOURCES][]    = 'default';

/**
 * Data container callback service for components.
 *
 * @var ComponentCallbacks
 */
$container[TimelineServices::DCA_COMPONENT] = $container->share(
    function ($container) {
        return new ComponentCallbacks($container[Services::TRANSLATOR]);
    }
);

/**
 * Data container callback service for timeline.
 *
 * @var TimelineCallbacks
 */
$container[TimelineServices::DCA_TIMELINE] = $container->share(
    function ($container) {
        return new TimelineCallbacks(
            $container[Services::DCA_MANAGER],
            $container[TimelineServices::DATA_SOURCES],
            $container[TimelineServices::TIMELINE_PROVIDER]
        );
    }
);

/**
 * Data container callback service for timeline entries.
 *
 * @var EntryCallbacks
 */
$container[TimelineServices::DCA_ENTRY] = $container->share(
    function ($container) {
        return new EntryCallbacks(
            $container[Services::DCA_MANAGER],
            $container[TimelineServices::TIMELINE_PROVIDER],
            $container[Services::TRANSLATOR]
        );
    }
);
