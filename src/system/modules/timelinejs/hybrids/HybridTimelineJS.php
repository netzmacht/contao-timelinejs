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
 * Namespace
 */
namespace Netzmacht\TimelineJS;


/**
 * Class HybridTimelineJS
 *
 * @copyright  2013 netzmacht creative David Molineus 
 * @author     netzmacht creative David Molineus 
 * @package    Netzmacht\TimelineJS
 */
class HybridTimelineJS extends \Hybrid
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'timelinejs';

	/**
	 * hybrid table
	 * @var string
	 */
	protected $strTable = 'tl_timelinejs';

	/**
	 * hybrid key
	 * @var string
	 */
	protected $strKey = 'timeline';


	/**
	 * Generate the module
	 */
	protected function compile()
	{
		$this->Template->source = sprintf('%s%s/system/modules/timelinejs/public/json.php?id=%s',
			\Environment::get('url'),
			$GLOBALS['TL_CONFIG']['websitePath'],
			$this->id
		);

		$this->Template->font = $this->fonts;
		$misc = deserialize($this->misc, true);

		$this->Template->startAtEnd = in_array('startAtEnd', $misc) ? 'true' : 'false';
		$this->Template->hashBookmarks = in_array('hashBookmarks', $misc) ? 'true' : 'false';
		$this->Template->debug = in_array('debug', $misc);

	}
}
