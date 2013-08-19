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
 * Initialize the system
 */
define('TL_MODE', 'FE');
require_once '../../initialize.php';

$controller = new Netzmacht\TimelineJS\JSONController();
$controller->run();