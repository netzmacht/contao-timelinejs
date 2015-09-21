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
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_content']['metapalettes']['TimelineJS'] = array(
    'type'      => array('type', 'headline'),
    'include'   => array('timeline'),
    'protected' => array(':hide', 'protected'),
    'expert'    => array(':hide', 'guests', 'cssID', 'space'),
    'invisible' => array(':hide', 'invisible', 'start', 'stop'),
);


/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['timeline'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_content']['timeline'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => array('Netzmacht\Contao\TimelineJs\Dca\HybridCallbacks', 'getTimelineOptions'),
    'eval'             => array(
        'mandatory'          => true,
        'includeBlankOption' => true,
        'chosen'             => true,
        'tl_class'           => 'w50 wizard',
    ),
    'wizard'           => array(
        array('Netzmacht\Contao\TimelineJs\Dca\HybridCallbacks', 'getTimelineEditButton')
    ),
    'sql'              => "int(10) unsigned NOT NULL"
);
