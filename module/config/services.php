<?php

/**
 * @package    netzmacht
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht David Molineus. All rights reserved.
 * @filesource
 *
 */

use Interop\Container\ContainerInterface;
use Netzmacht\Contao\TimelineJs\Dca\ComponentCallbacks;
use Netzmacht\Contao\Toolkit\DependencyInjection\Services;

global $container;

$container['timelinejs.dca.component-callbacks'] = $container->share(
    function ($container) {
        return new ComponentCallbacks($container[Services::TRANSLATOR]);
    }
);

$container['timelinejs.component-factory'] = $container->share(
    function () {
        return function ($model, $column, ContainerInterface $container) {
            return new \Netzmacht\Contao\TimelineJs\Frontend\HybridTimeline(
                $model,
                $container->get(Services::TEMPLATE_FACTORY),
                $container->get(Services::TRANSLATOR),
                $container->get(Services::ENVIRONMENT)->get('url'),
                $container->get(Services::CONFIG)->get('websitePath'),
                $column
            );
        };
    }
);
