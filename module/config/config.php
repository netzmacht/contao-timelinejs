<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */


/*
 * Backend modules
 */
$GLOBALS['BE_MOD']['content']['TimelineJS'] = array
(
    'icon'   => 'system/modules/timelinejs/assets/timeline.png',
    'tables' => array('tl_timelinejs', 'tl_timelinejs_entry'),
);

/*
 * Frontend modules and elements.
 */
$GLOBALS['FE_MOD']['application']['TimelineJS'] = function ($model, $column, $container) {
    return new \Netzmacht\Contao\TimelineJs\Frontend\HybridTimeline(
        $model,
        $container->get(\Netzmacht\Contao\Toolkit\DependencyInjection\Services::TEMPLATE_FACTORY),
        $container->get(\Netzmacht\Contao\Toolkit\DependencyInjection\Services::TRANSLATOR),
        $container->get(\Netzmacht\Contao\Toolkit\DependencyInjection\Services::ENVIRONMENT)->get('url'),
        $container->get(\Netzmacht\Contao\Toolkit\DependencyInjection\Services::CONFIG)->get('websitePath'),
        $column
    );
};

$GLOBALS['TL_CTE']['includes']['TimelineJS'] = function ($model, $column, $container) {
    return new \Netzmacht\Contao\TimelineJs\Frontend\HybridTimeline(
        $model,
        $container->get(\Netzmacht\Contao\Toolkit\DependencyInjection\Services::TEMPLATE_FACTORY),
        $container->get(\Netzmacht\Contao\Toolkit\DependencyInjection\Services::TRANSLATOR),
        $container->get(\Netzmacht\Contao\Toolkit\DependencyInjection\Services::ENVIRONMENT)->get('url'),
        $container->get(\Netzmacht\Contao\Toolkit\DependencyInjection\Services::CONFIG)->get('websitePath'),
        $column
    );
};

/*
 * Models.
 */
$GLOBALS['TL_MODELS']['tl_timelinejs']       = 'Netzmacht\Contao\TimelineJs\Model\TimelineModel';
$GLOBALS['TL_MODELS']['tl_timelinejs_entry'] = 'Netzmacht\Contao\TimelineJs\Model\EntryModel';
