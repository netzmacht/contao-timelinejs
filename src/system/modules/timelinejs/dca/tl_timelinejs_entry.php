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
 * Table tl_timelinejs_entry 
 */
$GLOBALS['TL_DCA']['tl_timelinejs_entry'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'ptable'                      => 'tl_timelinejs',
		'onsubmit_callback'           => array(
			array('Netzmacht\\TimelineJS\\TimelineJSEntryDataContainer', 'updateCache'),
		),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'headerFields'            => array('title'),
			'fields'                  => array('startDate'),
			'child_record_callback'   => array('Netzmacht\TimelineJS\TimelineJSEntryDataContainer', 'listEntry'),
			'panelLayout'             => 'sort,filter;search,limit',
			'flag'                    => 3,
		),
		'label' => array
		(
			'fields'                  => array('startDate', 'headline'),
			'format'                  => '%s: %s'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['copy'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('Netzmacht\\TimelineJS\\TimelineJSEntryDataContainer', 'generateButtonToggle'),
				'button_rules'        => array('toggleIcon', 'generate'),
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Edit
	'edit' => array
	(
		'buttons_callback' => array()
	),

	// Palettes
	'metapalettes' => array
	(
		'default' => array
		(
			'entry' => array('headline', 'startDate', 'endDate', 'teaser', 'tags', 'era'),
			'media' => array('media'),
			'published' => array('published'),
		)
	),

	// Subpalettes
	'metasubpalettes' => array
	(
		'media' => array('singleSRC', 'url', 'caption', 'credit', 'thumbnail'),
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'pid' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL"
		),
		'headline' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['headline'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'search'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'startDate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['startDate'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'length'                  => 4,
			'search'                  => true,
			'filter'                  => true,
			'eval'                    => array('mandatory'=>false, 'doNotCopy'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(15) NOT NULL default ''"
		),
		'endDate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['endDate'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'search'                  => true,
			'filter'                  => true,
			'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50'),
			'save_callback' => array
			(
			),
			'sql'                     => "varchar(15) NOT NULL default ''"
		),
		'teaser' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['teaser'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
			'sql'                     => "text NULL"
		),
		'media' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['media'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'eval'                    => array('submitOnChange' => true, 'maxlength'=>255),
			'sql'                     => "char(1) NOT NULL default ''",
		),
		'singleSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['singleSRC'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'filesOnly'=>true, 'mandatory'=>false),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'url' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['url'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'credit' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['credit'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'caption' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['caption'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'thumbnail' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['thumbnail'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('mandatory'=>false),
			'eval'                    => array('fieldType'=>'radio', 'filesOnly'=>true, 'maxlength'=>255, 'tl_class' => 'clr'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'era' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['era'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50 m12'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'tags' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['tags'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 2,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
	)
);
