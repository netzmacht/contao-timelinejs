<?php

/**
 * @package    netzmacht
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht David Molineus. All rights reserved.
 * @filesource
 *
 */

use Netzmacht\Contao\TimelineJs\Dca\ComponentCallbacks;
use Netzmacht\Contao\Toolkit\DependencyInjection\Services;

global $container;

$container['timelinejs.dca.component-callbacks'] = $container->share(
    function ($container) {
        return new ComponentCallbacks($container[Services::TRANSLATOR]);
    }
);
