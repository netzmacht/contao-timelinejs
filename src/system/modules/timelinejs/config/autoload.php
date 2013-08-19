<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * @package Timelinejs
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Netzmacht',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Models
	'Contao\TimelineJSEntryModel'                        => 'system/modules/timelinejs/models/TimelineJSEntryModel.php',
	'Contao\TimelineJSModel'                             => 'system/modules/timelinejs/models/TimelineJSModel.php',

	// Classes
	'Netzmacht\TimelineJS\TimelineJSEntryDataContainer'  => 'system/modules/timelinejs/classes/TimelineJSEntryDataContainer.php',
	'Netzmacht\TimelineJS\TimelineJSHybridDataContainer' => 'system/modules/timelinejs/classes/TimelineJSHybridDataContainer.php',
	'Netzmacht\TimelineJS\TimelineJSDataContainer'       => 'system/modules/timelinejs/classes/TimelineJSDataContainer.php',
	'Netzmacht\TimelineJS\JSONController'                => 'system/modules/timelinejs/classes/JSONController.php',

	// Hybrids
	'Netzmacht\TimelineJS\HybridTimelineJS'              => 'system/modules/timelinejs/hybrids/HybridTimelineJS.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'timelinejs' => 'system/modules/timelinejs/templates',
));
