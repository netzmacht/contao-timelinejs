<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
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
$GLOBALS['FE_MOD']['application']['TimelineJS'] = 'Netzmacht\Contao\TimelineJs\Frontend\HybridTimeline';
$GLOBALS['TL_CTE']['includes']['TimelineJS']    = 'Netzmacht\Contao\TimelineJs\Frontend\HybridTimeline';


/*
 * Models
 */
$GLOBALS['TL_MODELS']['tl_timelinejs']       = 'Netzmacht\Contao\TimelineJs\Model\TimelineModel';
$GLOBALS['TL_MODELS']['tl_timelinejs_entry'] = 'Netzmacht\Contao\TimelineJs\Model\EntryModel';
