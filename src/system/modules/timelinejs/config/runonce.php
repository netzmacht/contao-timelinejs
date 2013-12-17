<?php

namespace Netzmacht\TimelineJS;

require_once '../../../initialize.php';

/**
 * Class RunOnce
 */
class Updater
{

	/**
	 *
	 */
	public function run()
	{
		$this->removeCacheDir();
		$this->updateDatabaseFields();
	}


	/**
	 *
	 */
	protected function removeCacheDir()
	{
		if(is_dir(TL_ROOT . '/system/cache/timelinejs'))
		{
			// Purge the folder
			$objFolder = new \Folder('system/cache/timelinejs');
			$objFolder->purge();
			$objFolder->delete();

			// Add a log entry
			\Controller::log('Removed not used timelinejs cache directory', 'TimelineJSRunOnce run()', TL_CRON);
		}
	}


	/**
	 *
	 */
	protected function updateDatabaseFields()
	{
		if (version_compare(VERSION, '3.1', '>')) {
			\Database\Updater::convertSingleField('tl_timelinejs', 'singleSRC');
			\Database\Updater::convertSingleField('tl_timelinejs_entry', 'singleSRC');
			\Database\Updater::convertSingleField('tl_timelinejs_entry', 'thumbnail');
		}
	}

}

$controller = new Updater();
$controller->run();