<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

use Doctrine\Common\Cache\ApcCache;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\FilesystemCache;
use Netzmacht\Contao\TimelineJs\TimelineProvider;
use Netzmacht\JavascriptBuilder\Builder;

global $container;

if (!isset($container['timelinejs.debug-mode'])) {
    $container['timelinejs.debug-mode'] = !$container['toolkit.production-mode'];
}

$container['timelinejs.builder'] = $container->share(
    function () {
        return new Builder();
    }
);

$container['timelinejs.cache'] = $container->share(
    function ($container) {
        if ($container['timelinejs.debug-mode']) {
            return new ArrayCache();
        } elseif (extension_loaded('apc') && ini_get('apc.enabled')) {
            return new ApcCache();
        } else {
            return new FilesystemCache(TL_ROOT . '/system/cache/timelinejs');
        }
    }
);

$container['timelinejs.provider'] = $container->share(
    function ($container) {
        return new TimelineProvider(
            $container['event-dispatcher'],
            $container['timelinejs.builder'],
            $container['timelinejs.cache']
        );
    }
);
