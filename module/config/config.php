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
    $factory = $container->get('timelinejs.component-factory');

    return $factory($model, $column, $container);
};

$GLOBALS['TL_CTE']['includes']['TimelineJS'] = function ($model, $column, $container) {
    $factory = $container->get('timelinejs.component-factory');

    return $factory($model, $column, $container);
};

/*
 * Models.
 */
$GLOBALS['TL_MODELS']['tl_timelinejs']       = 'Netzmacht\Contao\TimelineJs\Model\TimelineModel';
$GLOBALS['TL_MODELS']['tl_timelinejs_entry'] = 'Netzmacht\Contao\TimelineJs\Model\EntryModel';
