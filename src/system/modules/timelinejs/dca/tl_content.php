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
$GLOBALS['TL_DCA']['tl_content']['metapalettes']['TimelineJS'] = array(
	'type' => array('type', 'headline'),
	'include' => array('timeline'),
	'protected' => array(':hide', 'protected'),
	'expert' => array(':hide', 'guests', 'cssID', 'space'),
	'invisible' => array(':hide', 'invisible', 'start', 'stop'),
);


/**
 * fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['timeline'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['timeline'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('Netzmacht\\TimelineJS\\TimelineJSHybridDataContainer', 'getTimelines'),
	'eval'                    => array('mandatory'=>true, 'includeBlankOption' => true, 'maxlength'=>255, 'tl_class' => 'wizard', 'submitOnChange' => true),
	'wizard'                   => array(
		array('Netzmacht\\TimelineJS\\TimelineJSHybridDataContainer', 'getTimelineEditButton')
	),
	'sql'                     => "int(10) unsigned NOT NULL"
);