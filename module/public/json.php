<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

use Netzmacht\Contao\TimelineJs\Frontend\JSONController;

/*
 * Initialize the system
 */
define('TL_MODE', 'FE');
require_once dirname(dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])))) . '/initialize.php';

$provider = $GLOBALS['container']['timelinejs.provider'];
$input    = $GLOBALS['container']['input'];

$controller = new JSONController($provider, $input);
$controller->run();
