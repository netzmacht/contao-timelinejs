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
 * palettes
 */
$GLOBALS['TL_DCA']['tl_module']['metapalettes']['TimelineJS'] = array(
	'type' => array('type'),
	'timeline' => array('timeline'),
);


/**
 * fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['timeline'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['timeline'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('Netzmacht\\TimelineJS\\TimelineJSHybridDataContainer', 'getTimelines'),
	'eval'                    => array('mandatory'=>true, 'includeBlankOption' => true, 'maxlength'=>255, 'tl_class' => 'wizard', 'submitOnChange' => true),
	'wizard'                   => array(
		array('Netzmacht\\TimelineJS\\TimelineJSHybridDataContainer', 'getTimelineEditButton')
	),
	'sql'                     => "int(10) unsigned NOT NULL"
);