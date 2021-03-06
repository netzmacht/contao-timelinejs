<?php

/**
 * Contao TimelineJS.
 *
 * @package   Contao TimelineJS.
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */


/*
 * Backend modules
 */
$GLOBALS['BE_MOD']['content']['timelinejs'] = array
(
    'icon'   => 'system/modules/timelinejs/assets/timeline.png',
    'tables' => array('tl_timelinejs', 'tl_timelinejs_entry'),
);

/*
 * Frontend modules and elements.
 */
$GLOBALS['FE_MOD']['application']['TimelineJS'] = 'Netzmacht\Contao\Toolkit\Component\Module\ModuleDecorator';
$GLOBALS['TL_CTE']['includes']['TimelineJS']    = 'Netzmacht\Contao\Toolkit\Component\ContentElement\ContentElementDecorator';

/*
 * Models.
 */
$GLOBALS['TL_MODELS']['tl_timelinejs']       = 'Netzmacht\Contao\TimelineJs\Model\TimelineModel';
$GLOBALS['TL_MODELS']['tl_timelinejs_entry'] = 'Netzmacht\Contao\TimelineJs\Model\EntryModel';

/*
 * Maintenance.
 */
$GLOBALS['TL_PURGE']['custom']['timelinejs'] = [
    'callback' => ['Netzmacht\Contao\TimelineJs\Backend\Maintenance', 'purgeCache'],
];
