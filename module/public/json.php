<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */

use Netzmacht\Contao\TimelineJs\Frontend\JSONController;
use Netzmacht\Contao\Toolkit\DependencyInjection\Services;

/*
 * Initialize the system
 */
define('TL_MODE', 'FE');
require_once dirname(dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])))) . '/initialize.php';

$provider = $GLOBALS['container']['timelinejs.provider'];
$input    = $GLOBALS['container'][Services::INPUT];

$controller = new JSONController($provider);
$controller->execute($input);
