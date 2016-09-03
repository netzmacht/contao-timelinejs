<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\TimelineJs\Backend;

use Netzmacht\Contao\TimelineJs\DependencyInjection\TimelineServices;
use Netzmacht\Contao\Toolkit\DependencyInjection\ContainerAware;
use Netzmacht\Contao\Toolkit\DependencyInjection\Services;

/**
 * Maintenance class is responsible to clear the cache.
 *
 * @package Netzmacht\Contao\TimelineJs\Backend
 */
class Maintenance
{
    use ContainerAware;

    /**
     * The timeline js cache directory.
     * @var string
     */
    private $cacheDir;

    /**
     * File system.
     *
     * @var \Files
     */
    private $fileSystem;

    /**
     * Maintenance constructor.
     */
    public function __construct()
    {
        $container        = $this->getContainer();
        $this->fileSystem = $container->get(Services::FILE_SYSTEM);
        $this->cacheDir   = $container->get(TimelineServices::CACHE_DIR);
    }

    /**
     * Purge the cache directory.
     *
     * @return void
     */
    public function purgeCache()
    {
        $this->fileSystem->rrdir($this->cacheDir, true);
    }
}
