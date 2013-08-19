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

namespace Contao;

/**
 * Class TimelineJSEntryModel
 */
class TimelineJSEntryModel extends Model
{

	/**
	 * @var string
	 */
	protected static $strTable = 'tl_timelinejs_entry';


	/**
	 * @param $intPid
	 * @return \Model\Collection|null
	 */
	public static function findPublishedByPid($intPid, $arrOptions=null)
	{
		$t = static::$strTable;
		$arrColumns = array("$t.pid=? AND $t.published=1");


		return static::findBy($arrColumns, $intPid, array(), $arrOptions);
	}
}