<?php

require_once '../../../initialize.php';

/**
 * Class RunOnce
 */
class TimelineJSRunOnce
{

	public function run()
	{
		if(is_dir(TL_ROOT . '/system/cache/timelinejs'))
		{
			// Purge the folder
			$objFolder = new \Folder('system/cache/timelinejs');
			$objFolder->purge();
			$objFolder->delete();

			// Add a log entry
			$this->log('Removed not used timelinejs cache directory', 'TimelineJSRunOnce run()', TL_CRON);
		}
	}
}

$controller = new TimelineJSRunOnce();
$controller->run();