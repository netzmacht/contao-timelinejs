<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

/**
 * Table tl_timelinejs_entry
 */
$GLOBALS['TL_DCA']['tl_timelinejs_entry'] = array
(

    // Config
    'config'                => array
    (
        'dataContainer'    => 'Table',
        'enableVersioning' => true,
        'ptable'           => 'tl_timelinejs',
        'sql'              => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        )
    ),
    // List
    'list'                  => array
    (
        'sorting'           => array
        (
            'mode'                  => 4,
            'headerFields'          => array('title'),
            'fields'                => array('type'),
            'child_record_callback' => array('Netzmacht\Contao\TimelineJs\Dca\EntryCallbacks', 'listEntry'),
            'panelLayout'           => 'filter,sort;search,limit',
            'flag'                  => 12,
        ),
        'label'             => array
        (
            'fields' => array('type', 'headline', 'startDate'),
            'format' => '%s: %s [%s]'
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"'
            )
        ),
        'operations'        => array
        (
            'edit'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif'
            ),
            'copy'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['copy'],
                'href'  => 'act=copy',
                'icon'  => 'copy.gif'
            ),
            'toggle' => array
            (
                'label'           => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['copy'],
                'icon'            => 'visible.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => \Netzmacht\Contao\Toolkit\Dca::createToggleIconCallback(
                    'tl_timelinejs_entry',
                    'published'
                )
            ),
            'delete' => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.gif'
            )
        )
    ),
    // Edit
    'edit'                  => array
    (
        'buttons_callback' => array()
    ),
    // Palettes
    'palettes'              => array('__selector__' => array('type')),
    'metapalettes'          => array
    (
        '_base_'               => array(
            'entry' => array('headline', 'type', 'published'),
            'date'  => array(),
            'text'  => array('text'),
            'media' => array(),
        ),
        'default'              => array
        (
            'entry'     => array('headline', 'type'),
            'published' => array('published'),
        ),
        'event extends _base_' => array
        (
            '+entry' => array('category before published'),
            'date'   => array('startDate', 'startDisplay', 'endDate', 'endDisplay', 'dateDisplay', 'dateFormat'),
            'text'   => array('text'),
            'media'  => array('media'),
        ),
        'title extends _base_' => array(
            'text'  => array('text'),
            'media' => array('media'),
        ),
        'era extends _base_'   => array(
            'date' => array('startDate', 'endDate'),
        )
    ),
    // Subpalettes
    'metasubselectpalettes' => array
    (
        'media' => array(
            'media'  => array('mediaUrl', 'mediaCaption', 'mediaCredit', 'mediaThumbnail'),
            'iframe' => array('mediaUrl', 'mediaCaption', 'mediaCredit', 'mediaThumbnail'),
            'quote'  => array('mediaQuote', 'mediaCaption', 'mediaCredit', 'mediaThumbnail'),
        )
    ),
    // Fields
    'fields'                => array
    (
        'id'             => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp'         => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'pid'            => array
        (
            'sql' => "int(10) unsigned NOT NULL"
        ),
        'headline'       => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['headline'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'type'           => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['type'],
            'exclude'   => true,
            'inputType' => 'select',
            'filter'    => true,
            'sorting'   => true,
            'options'   => array('event', 'title', 'era'),
            'eval'      => array(
                'mandatory'          => true,
                'tl_class'           => 'w50',
                'includeBlankOption' => true,
                'submitOnChange'     => true,
                'chosen'             => true,
            ),
            'sql'       => "varchar(16) NOT NULL default ''"
        ),
        'startDate'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['startDate'],
            'exclude'   => true,
            'inputType' => 'text',
            'sorting'   => true,
            'flag'      => 3,
            'length'    => 4,
            'eval'      => array('mandatory' => false, 'tl_class' => 'w50', 'maxlength' => 32),
            'sql'       => "varchar(32) NOT NULL default ''"
        ),
        'startDisplay'   => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['startDisplay'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('mandatory' => false, 'tl_class' => 'w50'),
            'sql'       => "varchar(64) NOT NULL default ''"
        ),
        'endDate'        => array
        (
            'label'         => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['endDate'],
            'exclude'       => true,
            'inputType'     => 'text',
            'search'        => true,
            'eval'          => array('tl_class' => 'w50', 'maxlength' => 32),
            'save_callback' => array
            (),
            'sql'           => "varchar(32) NOT NULL default ''"
        ),
        'endDisplay'     => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['endDisplay'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('mandatory' => false, 'tl_class' => 'w50'),
            'sql'       => "varchar(64) NOT NULL default ''"
        ),
        'dateDisplay'    => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['dateDisplay'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('mandatory' => false, 'tl_class' => 'w50'),
            'sql'       => "varchar(64) NOT NULL default ''"
        ),
        'dateFormat'     => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['dateFormat'],
            'exclude'   => true,
            'inputType' => 'text',
            'search'    => true,
            'eval'      => array('mandatory' => false, 'tl_class' => 'w50'),
            'sql'       => "varchar(64) NOT NULL default ''"
        ),
        'text'           => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['text'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'textarea',
            'eval'      => array('rte' => 'tinyMCE', 'tl_class' => 'clr'),
            'sql'       => "text NULL"
        ),
        'media'          => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['media'],
            'exclude'   => true,
            'inputType' => 'select',
            'filter'    => true,
            'options'   => array('media', 'iframe', 'quote'),
            'eval'      => array(
                'submitOnChange'     => true,
                'includeBlankOption' => true,
                'maxlength'          => 255,
                'chosen'             => true
            ),
            'sql'       => "varchar(8) NOT NULL default ''",
        ),
        'mediaUrl'       => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['mediaUrl'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array(
                'decodeEntities' => true,
                'mandatory'      => false,
                'maxlength'      => 255,
                'tl_class'       => 'w50 wizard',
                'files'          => true,
                'filesOnly'      => true,
                'fieldType'      => 'radio',
                'extensions'     => 'jpg,png,gif'
            ),
            'wizard'    => array(
                array('Netzmacht\Contao\TimelineJs\Dca\EntryCallbacks', 'filePicker'),
            ),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'mediaCredit'    => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['mediaCredit'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'mediaCaption'   => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['mediaCaption'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'mediaThumbnail' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['mediaThumbnail'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array(
                'decodeEntities' => true,
                'fieldType'      => 'radio',
                'filesOnly'      => true,
                'maxlength'      => 255,
                'tl_class'       => 'w50 wizard',
                'files'          => true,
                'extensions'     => 'jpg,png,gif'
            ),
            'wizard'    => array(
                array('Netzmacht\Contao\TimelineJs\Dca\EntryCallbacks', 'filePicker'),
            ),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'mediaQuote'     => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['mediaQuote'],
            'exclude'   => true,
            'inputType' => 'textarea',
            'eval'      => array('rte' => 'tinyMCE', 'tl_class' => 'clr', 'rows' => 5),
            'sql'       => "text NULL"
        ),
        'era'            => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['era'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'w50 m12'),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'category'       => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['category'],
            'exclude'   => true,
            'filter'    => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'published'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs_entry']['published'],
            'exclude'   => true,
            'filter'    => true,
            'flag'      => 2,
            'inputType' => 'checkbox',
            'eval'      => array('doNotCopy' => true, 'tl_class' => 'm12 w50'),
            'sql'       => "char(1) NOT NULL default ''"
        ),
    )
);
