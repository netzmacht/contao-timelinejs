<?php
/**
 * Created by JetBrains PhpStorm.
 * User: david
 * Date: 19.08.13
 * Time: 10:11
 * To change this template use File | Settings | File Templates.
 */

namespace Netzmacht\TimelineJS;


/**
 * Class TimelineJSDataContainer
 * @package Netzmacht\TimelineJS
 */
class TimelineJSDataContainer
{

	/**
	 * @param \DC_Table $dc
	 */
	public function updateCache(\DC_Table $dc)
	{
		$controller = new JSONController();
		$controller->createCache($dc->id);
	}

}