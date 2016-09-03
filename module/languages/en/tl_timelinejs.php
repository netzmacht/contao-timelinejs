<?php

/**
 * Contao TimelineJS.
 *
 * @package   Contao TimelineJS.
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */

//buttons
$GLOBALS['TL_LANG']['tl_timelinejs']['new'][0]    = 'New timeline';
$GLOBALS['TL_LANG']['tl_timelinejs']['new'][1]    = 'Create new timeline';
$GLOBALS['TL_LANG']['tl_timelinejs']['edit'][0]   = 'Edit timeline';
$GLOBALS['TL_LANG']['tl_timelinejs']['edit'][1]   = 'Edit timeline ID %s';
$GLOBALS['TL_LANG']['tl_timelinejs']['delete'][0] = 'Delete timeline';
$GLOBALS['TL_LANG']['tl_timelinejs']['delete'][1] = 'Delete timeline ID %s';
$GLOBALS['TL_LANG']['tl_timelinejs']['copy'][0]   = 'Copy timeline';
$GLOBALS['TL_LANG']['tl_timelinejs']['copy'][1]   = 'Copy timeline ID %s';
$GLOBALS['TL_LANG']['tl_timelinejs']['show'][0]   = 'Show timeline';
$GLOBALS['TL_LANG']['tl_timelinejs']['show'][1]   = 'Show timeline ID %s';


//legends
$GLOBALS['TL_LANG']['tl_timelinejs']['title_legend']   = 'Title';
$GLOBALS['TL_LANG']['tl_timelinejs']['config_legend']  = 'Configuration';
$GLOBALS['TL_LANG']['tl_timelinejs']['options_legend'] = 'Options';
$GLOBALS['TL_LANG']['tl_timelinejs']['style_legend']   = 'Style';
$GLOBALS['TL_LANG']['tl_timelinejs']['browser_legend'] = 'Browser';
$GLOBALS['TL_LANG']['tl_timelinejs']['api_legend']     = 'API';


//fields
$GLOBALS['TL_LANG']['tl_timelinejs']['title'][0]           = 'Title';
$GLOBALS['TL_LANG']['tl_timelinejs']['title'][1]           = 'Please insert a title of the timeline.';
$GLOBALS['TL_LANG']['tl_timelinejs']['scale'][0]           = 'Scale';
$GLOBALS['TL_LANG']['tl_timelinejs']['scale'][1]           = 'Either human or cosmological.  The cosmological scale is required to handle dates in the very distant past or future. (Before Tuesday, April 20th, 271,821 BCE after Saturday, September 13 275,760 CE).';
$GLOBALS['TL_LANG']['tl_timelinejs']['dataSource'][0]      = 'Data source';
$GLOBALS['TL_LANG']['tl_timelinejs']['dataSource'][1]      = 'Please choose from which data source your events come from.';
$GLOBALS['TL_LANG']['tl_timelinejs']['startAtSlide'][0]    = 'Start at slide';
$GLOBALS['TL_LANG']['tl_timelinejs']['startAtSlide'][1]    = 'The first slide to display when the timeline is loaded.';
$GLOBALS['TL_LANG']['tl_timelinejs']['startAtEnd'][0]      = 'Start at the end.';
$GLOBALS['TL_LANG']['tl_timelinejs']['startAtEnd'][1]      = 'If checked, loads timeline on last slide.';
$GLOBALS['TL_LANG']['tl_timelinejs']['categories'][0]      = 'Categories';
$GLOBALS['TL_LANG']['tl_timelinejs']['categories'][1]      = 'Define a list of categories which should be available for each slide.';
$GLOBALS['TL_LANG']['tl_timelinejs']['sizes'][0]           = 'Size configuration';
$GLOBALS['TL_LANG']['tl_timelinejs']['sizes'][1]           = 'Please choose the values to define sizes.';
$GLOBALS['TL_LANG']['tl_timelinejs']['sizeOptionName'][0]  = 'Name';
$GLOBALS['TL_LANG']['tl_timelinejs']['sizeOptionName'][1]  = 'Name of the size option.';
$GLOBALS['TL_LANG']['tl_timelinejs']['sizeOptionValue'][0] = 'Value';
$GLOBALS['TL_LANG']['tl_timelinejs']['sizeOptionValue'][1] = 'Size option value.';
$GLOBALS['TL_LANG']['tl_timelinejs']['defaultBgColor'][0]  = 'Default background color';
$GLOBALS['TL_LANG']['tl_timelinejs']['defaultBgColor'][1]  = 'Default RGB values to use for slide backgrounds.';
$GLOBALS['TL_LANG']['tl_timelinejs']['baseClass'][0]       = 'Base css class';
$GLOBALS['TL_LANG']['tl_timelinejs']['baseClass'][1]       = 'Defining a custom base css class will remove all default styles.';
$GLOBALS['TL_LANG']['tl_timelinejs']['hashBookmarks'][0]   = 'Hash bookmarks';
$GLOBALS['TL_LANG']['tl_timelinejs']['hashBookmarks'][1]   = 'If checked, TimelineJS will update the browser URL each time a slide advances, so that people can link directly to specific slides.';
$GLOBALS['TL_LANG']['tl_timelinejs']['trackResize'][0]     = 'Track Resize';
$GLOBALS['TL_LANG']['tl_timelinejs']['trackResize'][1]     = 'Track browser window resize.';
$GLOBALS['TL_LANG']['tl_timelinejs']['ease'][0]            = 'Easing equation';
$GLOBALS['TL_LANG']['tl_timelinejs']['ease'][1]            = 'Easing equation of the animation. Default <em>TL.Ease.easeInOutQuint</em>';
$GLOBALS['TL_LANG']['tl_timelinejs']['duration'][0]        = 'Duration';
$GLOBALS['TL_LANG']['tl_timelinejs']['duration'][1]        = 'Duration of the animation.';
$GLOBALS['TL_LANG']['tl_timelinejs']['zoomSequence'][0]    = 'Zoom sequence';
$GLOBALS['TL_LANG']['tl_timelinejs']['zoomSequence'][1]    = 'Comma separated list of values for TimeNav zoom levels. Each value is a scale_factor, which means that at any given level, the full timeline would require that many screens to display all events.';
$GLOBALS['TL_LANG']['tl_timelinejs']['dragging'][0]        = 'Dragging';
$GLOBALS['TL_LANG']['tl_timelinejs']['dragging'][1]        = 'Enable dragging.';
$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeys'][0]         = 'API keys';
$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeys'][1]         = 'API keys.';
$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeyName'][0]      = 'Key name';
$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeyName'][1]      = 'Name of the API key';
$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeyValue'][0]     = 'Key value';
$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeyValue'][1]     = 'Value of the API key.';
$GLOBALS['TL_LANG']['tl_timelinejs']['mapType'][0]         = 'Map type';
$GLOBALS['TL_LANG']['tl_timelinejs']['mapType'][1]         = 'Choose the type of the map.';

