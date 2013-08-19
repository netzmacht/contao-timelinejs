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


/**
 * Class TimelineJSModuleDataContainer
 * @package Netzmacht\TimelineJS
 */
class TimelineJSHybridDataContainer extends \System
{

	/**
	 * get all timelines
	 * @return array
	 */
	public function getTimelines()
	{
		$timelines = \TimelineJSModel::findAll();
		$return = array();

		if($timelines !== null)
		{
			while($timelines->next())
			{
				$return[$timelines->id] = $timelines->title;
			}

		}

		return $return;
	}


	/**
	 * add timeline edit button as wizard
	 * @param $dc
	 * @return string
	 */
	public function getTimelineEditButton($dc)
	{
		if($dc->activeRecord->timeline == 0) {
			return '';
		}

		$table = \Input::get('table');

		return sprintf(
			'<a href="%s" title="%s"><img src="system/themes/default/images/edit.gif" alt="%s" style="padding-left:5px"></a>',
			$this->addToUrl('do=TimelineJS&amp;table=tl_timelinejs_entry&amp;act=&amp;id=' . $dc->activeRecord->timeline),
			sprintf($GLOBALS['TL_LANG'][$table]['timeline_edit'][1], $dc->activeRecord->timeline),
			$GLOBALS['TL_LANG'][$table]['timeline_edit'][0]
		);
	}

}