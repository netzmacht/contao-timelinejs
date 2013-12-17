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
 * Table tl_timelinejs 
 */
$GLOBALS['TL_DCA']['tl_timelinejs'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'ctable'                      => array('tl_timelinejs_entry'),
		'onsubmit_callback'           => array(
			array('Netzmacht\\TimelineJS\\TimelineJSDataContainer', 'updateCache'),
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
			'mode'                    => 1,
			'fields'                  => array('title'),
			'flag'                    => 1
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s'
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
			'entry' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelinejs']['entry'],
				'href'                => 'table=tl_timelinejs_entry',
				'icon'                => 'edit.gif'
			),
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelinejs']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelinejs']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelinejs']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timelinejs']['show'],
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

	// palettes
	'metapalettes' => array(
		'default' => array(
			'title' => array('title', 'teaser'),
			'options' => array('width', 'height', 'language', 'fonts', 'misc', 'zoom', 'number'),
			'media' => array('media'),
			'template' => array('template'),
		),
	),

	// subpalettes
	'metasubpalettes' => array
	(
		'media' => array('singleSRC', 'caption', 'credit')
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
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs']['title'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'teaser' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs']['teaser'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
			'sql'                     => "text NULL"
		),
		'width' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs']['width'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'height' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs']['height'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'language' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs']['language'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array(
				'af', 'ar', 'bg', 'ca', 'cz', 'da', 'de', 'el', 'en', 'en24hr', 'es', 'eu', 'fi', 'fo', 'fr', 'gl',
				'hu', 'hy', 'id', 'is', 'it', 'iw', 'ja', 'ka', 'ko', 'kv', 'nl', 'no', 'pl', 'pt-br', 'pt', 'ru',
				'sk', 'sl', 'sr-cy', 'sr', 'sv',  'ta', 'tl', 'tr', 'zh-cn', 'zh-tw',
			),
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'map' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs']['map'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array(
				'stamen' => array('toner', 'toner-lines', 'toner-labels', 'watercolor', 'sterrain'),
				'google' => array('ROADMAP','TERRAIN', 'HYBRID', 'SATELLITE'),
			),
			'eval'                    => array('maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'gmapKey' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs']['gmapKey'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'fonts' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs']['fonts'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array(
				'Arvo-PTSans',
				'Merriweather-NewsCycle',
				'NewsCycle-Merriweather',
				'PoiretOne-Molengo',
				'PTSerif-PTSans',
				'DroidSerif-DroidSans',
				'Lekton-Molengo',
				'NixieOne-Ledger',
				'AbrilFatface-Average',
				'PlayfairDisplay-Muli',
				'Rancho-Gudea',
				'Bevan-PotanoSans',
				'BreeSerif-OpenSans',
				'SansitaOne-Kameron',
				'Pacifico-Arimo'

			),
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'misc' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs']['misc'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'options'                => array(
				'startAtEnd',
				'hashBookmarks',
				'debug',
			),
			'reference'               => &$GLOBALS['TL_LANG']['tl_timelinejs']['misc']['options'],
			'eval'                    => array('multiple' => true, 'mandatory'=>false, 'tl_class' => 'clr'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'zoom' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs']['zoom'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'number' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs']['number'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'media' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs']['media'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange' => true, 'maxlength'=>255),
			'sql'                     => "char(1) NOT NULL default ''",
		),
		'singleSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs']['singleSRC'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'filesOnly'=>true, 'mandatory'=>true),
			'sql'                     => "binary(16) NULL"
		),
		'credit' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs']['credit'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'caption' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timelinejs']['caption'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),

	)
);
