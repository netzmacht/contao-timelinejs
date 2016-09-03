<?php

/**
 * Contao TimelineJS.
 *
 * @package   Contao TimelineJS.
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */

use Netzmacht\Contao\TimelineJs\Builder\OptionsBuilder;
use Netzmacht\Contao\TimelineJs\Dca\TimelineCallbacks;
use Netzmacht\Contao\Toolkit\Dca;

$GLOBALS['TL_DCA']['tl_timelinejs'] = array
(
    // Config
    'config'          => array
    (
        'dataContainer'    => 'Table',
        'enableVersioning' => true,
        'ctable'           => array('tl_timelinejs_entry'),
        'sql'              => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        ),
        'onsubmit_callback' => [
            TimelineCallbacks::callback('purgeCache'),
        ],
    ),
    // List
    'list'            => array
    (
        'sorting'           => array
        (
            'mode'   => 1,
            'fields' => array('title'),
            'flag'   => 1
        ),
        'label'             => array
        (
            'fields' => array('title'),
            'format' => '%s'
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
            'entry'  => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_timelinejs']['entry'],
                'href'  => 'table=tl_timelinejs_entry',
                'icon'  => 'edit.gif'
            ),
            'edit'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_timelinejs']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'header.gif'
            ),
            'copy'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_timelinejs']['copy'],
                'href'  => 'act=copy',
                'icon'  => 'copy.gif'
            ),
            'delete' => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_timelinejs']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_timelinejs']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.gif'
            )
        )
    ),
    // palettes
    'metapalettes'    => array(
        'default' => array(
            'title'     => array('title', 'scale', 'language', 'dataSource', 'startAtSlide', 'startAtEnd'),
            'config'    => array('categories', 'relativeDate', 'useBc'),
            'options'   => array(':hide', 'sizes', 'layout', 'timenavPosition'),
            'style'     => array('width', 'height', 'fonts', 'defaultBgColor', 'baseClass'),
            'browser'   => array('hashBookmarks', 'trackResize', 'ease', 'duration', 'zoomSequence', 'dragging', 'slideDefaultFade'),
            'api'       => array('apiKeys', 'mapType'),
            'analytics' => array(':hidden', 'gaPropertyId', 'trackEvents')
        ),
    ),
    // subpalettes
    'metasubpalettes' => array
    (),
    // Fields
    'fields'          => array
    (
        'id'              => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp'          => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'title'           => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['title'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'scale'           => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['scale'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => array('human', 'cosmological'),
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(16) NOT NULL default ''"
        ),
        'language'        => array
        (
            'label'            => &$GLOBALS['TL_LANG']['tl_timelinejs']['language'],
            'exclude'          => true,
            'inputType'        => 'select',
            'options_callback' => TimelineCallbacks::callback('getSupportedLanguages'),
            'eval'             => array(
                'mandatory'          => false,
                'maxlength'          => 8,
                'tl_class'           => 'w50',
                'chosen'             => true,
                'includeBlankOption' => true
            ),
            'sql'              => "varchar(8) NOT NULL default ''"
        ),
        'dataSource'      => array
        (
            'label'            => &$GLOBALS['TL_LANG']['tl_timelinejs']['dataSource'],
            'exclude'          => true,
            'inputType'        => 'select',
            'default'          => 'default',
            'options_callback' => TimelineCallbacks::callback('getDataSources'),
            'eval'             => array(
                'mandatory'          => true,
                'tl_class'           => 'w50',
                'includeBlankOption' => true,
                'submitOnChange'     => true
            ),
            'sql'              => "varchar(16) NOT NULL default ''"
        ),
        'width'           => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['width'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'height'          => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['height'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'sizes'           => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['sizes'],
            'exclude'   => true,
            'inputType' => 'multiColumnWizard',
            'options'   => OptionsBuilder::getSizeOptionNames(),
            'reference' => &$GLOBALS['TL_LANG']['tl_timelinejs']['sizesOptions'],
            'eval'      => array(
                'tl_class'     => 'clr',
                'helpwizard'   => true,
                'columnFields' => array(
                    'name'  => array(
                        'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['sizeOptionName'],
                        'inputType' => 'select',
                        'reference' => &$GLOBALS['TL_LANG']['tl_timelinejs']['sizesOptions'],
                        'options'   => OptionsBuilder::getSizeOptionNames(),
                        'eval'      => array('style' => 'width: 300px')
                    ),
                    'value' => array(
                        'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['sizeOptionValue'],
                        'inputType' => 'text',
                        'eval'      => array('style' => 'width: 100px')
                    ),
                )
            ),
            'sql'       => "blob NULL"
        ),
        'timenavPosition' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['scale'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => array('bottom', 'top'),
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(16) NOT NULL default ''"
        ),
        'layout'          => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['layout'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => array('landscape', 'portrait'),
            'eval'      => array(
                'mandatory'          => true,
                'tl_class'           => 'w50',
                'includeBlankOption' => true,
                'submitOnChange'     => true
            ),
            'sql'       => "varchar(16) NOT NULL default ''"
        ),
//        'relativeDate'    => array
//        (
//            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['relativeDate'],
//            'exclude'   => true,
//            'inputType' => 'checkbox',
//            'eval'      => array('tl_class' => 'w50 m12'),
//            'sql'       => "char(1) NOT NULL default ''"
//        ),
//        'useBc'           => array
//        (
//            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['useBc'],
//            'exclude'   => true,
//            'inputType' => 'checkbox',
//            'eval'      => array('tl_class' => 'w50'),
//            'sql'       => "char(1) NOT NULL default ''"
//        ),
        'hashBookmarks'           => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['hashBookmarks'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'w50'),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'mapType'         => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['mapType'],
            'exclude'   => true,
            'inputType' => 'select',
            'options' => array(
                'stamen' => array(
                    'stamen:toner-lite',
                    'stamen:toner-lines',
                    'stamen:toner-labels',
                    'stamen:watercolor',
                    'stamen:sterrain'
                ),
                'google' => array('ROADMAP', 'TERRAIN', 'HYBRID', 'SATELLITE'),
            ),
            'eval'      => array('maxlength' => 32, 'includeBlankOption' => true),
            'sql'       => "varchar(32) NOT NULL default ''"
        ),
        'apiKeys'         => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeys'],
            'exclude'   => true,
            'inputType' => 'multiColumnWizard',
            'options'   => array('apiKeyFlickr', 'apiKeyGooglemaps', 'gaPropertyId'),
            'reference' => &$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeyOptions'],
            'eval'      => array(
                'tl_class'     => 'clr',
                'helpwizard'   => true,
                'columnFields' => array(
                    'name'  => array(
                        'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeyName'],
                        'inputType' => 'select',
                        'reference' => &$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeyOptions'],
                        'options'   => array('apiKeyFlickr', 'apiKeyGooglemaps', 'gaPropertyId'),
                        'eval'      => array('style' => 'width: 180px', 'chosen' => true)
                    ),
                    'value' => array(
                        'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeyValue'],
                        'inputType' => 'text',
                        'eval'      => array('style' => 'width: 300px')
                    ),
                )
            ),
            'sql'       => "blob NULL"
        ),
        'fonts'           => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['fonts'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => array(
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
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'zoomSequence'    => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['zoomSequence'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => false, 'maxlength' => 64, 'tl_class' => 'w50', 'csv' => true),
            'sql'       => "varchar(64) NOT NULL default ''"
        ),
        'duration'    => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['duration'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => false, 'maxlength' => 4, 'tl_class' => 'w50', 'rgxp' => 'digit'),
            'sql'       => "varchar(4) NOT NULL default ''"
        ),
        'dragging'           => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['dragging'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'default'   => true,
            'eval'      => array('tl_class' => 'w50 m12'),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'trackResize'           => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['trackResize'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'default'   => true,
            'eval'      => array('tl_class' => 'w50'),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'ease'    => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['ease'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => false, 'maxlength' => 32, 'tl_class' => 'w50'),
            'sql'       => "varchar(32) NOT NULL default ''"
        ),
        'startAtSlide'    => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['startAtSlide'],
            'exclude'   => true,
            'inputType' => 'text',
            'default'   => 0,
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "int(10) unsigned NOT NULL default '0'"
        ),
        'startAtEnd'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['startAtEnd'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'w50 m12'),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'categories'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['categories'],
            'exclude'   => true,
            'inputType' => 'listWizard',
            'eval'      => array('multipt' => true, 'maxlength' => 255, 'style' => 'width: calc(50% - 90px)'),
            'sql'       => "mediumblob NULL"
        ),
        'defaultBgColor'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['defaultBgColor'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array(
                'decodeEntities' => true,
                'maxlength'      => 255,
                'tl_class'       => 'w50 wizard',
                'files'          => true,
                'filesOnly'      => true,
                'fieldType'      => 'radio',
                'extensions'     => 'jpg,png,gif'
            ),
            'wizard'    => array(
                Dca\Callback\CallbackFactory::colorPicker()
            ),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'baseClass'       => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_timelinejs']['baseClass'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => false, 'maxlength' => 64, 'tl_class' => 'w50'),
            'sql'       => "varchar(64) NOT NULL default ''"
        ),
    )
);
