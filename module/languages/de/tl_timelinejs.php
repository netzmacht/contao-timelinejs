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
$GLOBALS['TL_LANG']['tl_timelinejs']['new'][0]    = 'Neuen Zeitstrahl';
$GLOBALS['TL_LANG']['tl_timelinejs']['new'][1]    = 'Neuen Zeitstrahl anlegen';
$GLOBALS['TL_LANG']['tl_timelinejs']['edit'][0]   = 'Zeitstrahl bearbeiten';
$GLOBALS['TL_LANG']['tl_timelinejs']['edit'][1]   = 'Zeitstrahl ID %s bearbeiten';
$GLOBALS['TL_LANG']['tl_timelinejs']['delete'][0] = 'Zeitstrahl löschen';
$GLOBALS['TL_LANG']['tl_timelinejs']['delete'][1] = 'Zeitstrahl ID %s löschen';
$GLOBALS['TL_LANG']['tl_timelinejs']['copy'][0]   = 'Zeitstrahl duplizieren';
$GLOBALS['TL_LANG']['tl_timelinejs']['copy'][1]   = 'Zeitstrahl ID %s duplizieren';
$GLOBALS['TL_LANG']['tl_timelinejs']['show'][0]   = 'Zeitstrahl anzeigen';
$GLOBALS['TL_LANG']['tl_timelinejs']['show'][1]   = 'Zeitstrahl ID %s anzeigen';

//legends
$GLOBALS['TL_LANG']['tl_timelinejs']['title_legend']   = 'Titel';
$GLOBALS['TL_LANG']['tl_timelinejs']['config_legend']  = 'Konfiguration';
$GLOBALS['TL_LANG']['tl_timelinejs']['options_legend'] = 'Optionen';
$GLOBALS['TL_LANG']['tl_timelinejs']['style_legend']   = 'Style';
$GLOBALS['TL_LANG']['tl_timelinejs']['browser_legend'] = 'Browser';
$GLOBALS['TL_LANG']['tl_timelinejs']['api_legend']     = 'API';

//fields
$GLOBALS['TL_LANG']['tl_timelinejs']['title'][0]           = 'Title';
$GLOBALS['TL_LANG']['tl_timelinejs']['title'][1]           = 'Geben geben Sie einen Titel für den Zeitstrahl ein.';
$GLOBALS['TL_LANG']['tl_timelinejs']['scale'][0]           = 'Skala';
$GLOBALS['TL_LANG']['tl_timelinejs']['scale'][1]           = 'Entweder human oder cosmological.';
$GLOBALS['TL_LANG']['tl_timelinejs']['dataSource'][0]      = 'Datenquelle';
$GLOBALS['TL_LANG']['tl_timelinejs']['dataSource'][1]      = 'Aus welcher Datenquelle sollen die Events erstellt werden?';
$GLOBALS['TL_LANG']['tl_timelinejs']['startAtSlide'][0]    = 'Anfang';
$GLOBALS['TL_LANG']['tl_timelinejs']['startAtSlide'][1]    = 'Nummer des Eintrags, welcher zuerst angezeigt werden sol';
$GLOBALS['TL_LANG']['tl_timelinejs']['startAtEnd'][0]      = 'Mit letzten Eintrag beginnen';
$GLOBALS['TL_LANG']['tl_timelinejs']['startAtEnd'][1]      = 'Wenn ausgewählt, wird mit dem letzten Eintrag begonnen.';
$GLOBALS['TL_LANG']['tl_timelinejs']['categories'][0]      = 'Kategorien';
$GLOBALS['TL_LANG']['tl_timelinejs']['categories'][1]      = 'Definieren Sie Kategorien, die zur Gruppierung auf dem Zeitstrahl genutzt werden soll.';
$GLOBALS['TL_LANG']['tl_timelinejs']['sizes'][0]           = 'Größenkonfigurationen';
$GLOBALS['TL_LANG']['tl_timelinejs']['sizes'][1]           = 'Definieren Sie verschiedene Größenangaben.';
$GLOBALS['TL_LANG']['tl_timelinejs']['sizeOptionName'][0]  = 'Name';
$GLOBALS['TL_LANG']['tl_timelinejs']['sizeOptionName'][1]  = 'Name der Größenkonfiguration.';
$GLOBALS['TL_LANG']['tl_timelinejs']['sizeOptionValue'][0] = 'Wert';
$GLOBALS['TL_LANG']['tl_timelinejs']['sizeOptionValue'][1] = 'Wert der Größenkonfigurationen.';
$GLOBALS['TL_LANG']['tl_timelinejs']['defaultBgColor'][0]  = 'Standardhintergrundfarbe';
$GLOBALS['TL_LANG']['tl_timelinejs']['defaultBgColor'][1]  = 'Standard RGB Hintergrundfarbe';
$GLOBALS['TL_LANG']['tl_timelinejs']['baseClass'][0]       = 'Standard CSS-Klasse';
$GLOBALS['TL_LANG']['tl_timelinejs']['baseClass'][1]       = 'Wird hier eine Klasse eingetragen, verliert die Timline ihren Standard-Stil.';
$GLOBALS['TL_LANG']['tl_timelinejs']['hashBookmarks'][0]   = 'Bookmmark Hashes';
$GLOBALS['TL_LANG']['tl_timelinejs']['hashBookmarks'][1]   = 'Wenn aktiviert, wird jeder Eintrag mit einem Anker Bookmark versehen und die Url des Browsers dementsprechend angepasst.';
$GLOBALS['TL_LANG']['tl_timelinejs']['trackResize'][0]     = 'Größenveränderungen registrieren';
$GLOBALS['TL_LANG']['tl_timelinejs']['trackResize'][1]     = 'Die Timeline soll auf Größenänderungen des Browsers reagieren.';
$GLOBALS['TL_LANG']['tl_timelinejs']['ease'][0]            = 'Easing equation';
$GLOBALS['TL_LANG']['tl_timelinejs']['ease'][1]            = 'Easing equation of the animation. Default <em>TL.Ease.easeInOutQuint</em>';
$GLOBALS['TL_LANG']['tl_timelinejs']['duration'][0]        = 'Dauer';
$GLOBALS['TL_LANG']['tl_timelinejs']['duration'][1]        = 'Dauer der Animation.';
$GLOBALS['TL_LANG']['tl_timelinejs']['zoomSequence'][0]    = 'Zoom sequence';
$GLOBALS['TL_LANG']['tl_timelinejs']['zoomSequence'][1]    = 'Comma separated list of values for TimeNav zoom levels. Each value is a scale_factor, which means that at any given level, the full timeline would require that many screens to display all events.';
$GLOBALS['TL_LANG']['tl_timelinejs']['dragging'][0]        = 'Dragging';
$GLOBALS['TL_LANG']['tl_timelinejs']['dragging'][1]        = 'Aktiviere Dragging.';
$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeys'][0]         = 'API Schlüssel';
$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeys'][1]         = 'API Schlüssel.';
$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeyName'][0]      = 'Name';
$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeyName'][1]      = 'Name des API Schlüssels';
$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeyValue'][0]     = 'API Schlüssel';
$GLOBALS['TL_LANG']['tl_timelinejs']['apiKeyValue'][1]     = 'Wert des API Schlüssels.';
$GLOBALS['TL_LANG']['tl_timelinejs']['mapType'][0]         = 'Kartentyp';
$GLOBALS['TL_LANG']['tl_timelinejs']['mapType'][1]         = 'Bitte suchen Sie einen Kartentyp aus.';
