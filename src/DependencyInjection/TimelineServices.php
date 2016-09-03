<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\TimelineJs\DependencyInjection;

/**
 * Services provides by this extension.
 * 
 * @package Netzmacht\Contao\TimelineJs\DependencyInjection
 */
class TimelineServices
{
    /**
     * Internal used cache.
     * 
     * Instance of Doctrine\Common\Cache\Cache.
     */
    const CACHE = 'timelinejs.cache';

    /**
     * Relative path of the cache directory.
     */
    const CACHE_DIR = 'timelinejs.cache-dir';

    /**
     * Timeline provider which provides access to all timeline related data stuff.
     * 
     * Instance of Netzmacht\Contao\TimelineJs\TimelineProvider
     */
    const TIMELINE_PROVIDER = 'timelinejs.provider';

    /**
     * List of all supported data sources.
     * 
     * Instance of \ArrayObject
     */
    const DATA_SOURCES = 'timelinejs.datasources';

    /**
     * Data container callback class for components.
     */
    const DCA_COMPONENT = 'timelinejs.dca.component-callbacks';

    /**
     * Data container callback class for timelines.
     */
    const DCA_TIMELINE = 'timelinejs.dca.timelines';

    /**
     * Data container callback class for timeline entries.
     */
    const DCA_ENTRY = 'timelinejs.dca.entries';

    /**
     * Debug mode.
     */
    const DEBUG_MODE = 'timelinejs.debug-mode';
}
