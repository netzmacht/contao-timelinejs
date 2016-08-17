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
use Netzmacht\Contao\Toolkit\DependencyInjection\Services;

/*
 * Initialize the system
 */
define('TL_MODE', 'FE');
require_once dirname(dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])))) . '/initialize.php';

$container         = $GLOBALS['container'];
$input             = $container[Services::INPUT];
$insertTagReplacer = $container[Services::INSERT_TAG_REPLACER];

$controller = new JSONController($insertTagReplacer);
$controller->execute($input);
