<?php 

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * @package   timelinejs 
 * @author    netzmacht creative David Molineus 
 * @license   MPL/2.0 
 * @copyright 2013 netzmacht creative David Molineus 
 */


/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['content']['TimelineJS'] = array
(
	'icon' => 'system/modules/timelinejs/assets/timeline.png',
	'tables' => array('tl_timelinejs', 'tl_timelinejs_entry'),
);


/**
 * Frontend modules
 */
$GLOBALS['FE_MOD']['application']['TimelineJS'] = 'Netzmacht\\TimelineJS\\HybridTimelineJS';


/**
 * Content elements
 */
$GLOBALS['TL_CTE']['includes']['TimelineJS'] = 'Netzmacht\\TimelineJS\\HybridTimelineJS';


/**
 * Purge jobs
 */
$GLOBALS['TL_PURGE']['folders']['timelinejs'] = array
(
	'callback' => array('Netzmacht\\TimelineJS\\JSONController', 'purgeCache'),
	'affected' => array('system/cache/timelinejs')
);