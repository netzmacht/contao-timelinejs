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

namespace Netzmacht\TimelineJS;

use Netzmacht\Utils\DataContainer;


/**
 * Class TimelineJSEntryDataContainer
 * @package Netzmacht\TimelineJS
 */
class TimelineJSEntryDataContainer extends DataContainer
{

	/**
	 *
	 * @var string
	 */
	protected $strTable = 'tl_timelinejs_entry';


	/**
	 * @param $row
	 * @return string
	 */
	public function listEntry($row)
	{
		return $row['startDate'] . ': ' . $row['headline'];
	}

}