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
 * Class JSONController
 * @package Netzmacht\TimelineJS
 */
class JSONController extends \Frontend
{

	/**
	 * initialize controller
	 */
	public function __construct()
	{
		$this->import('BackendUser', 'User');
		parent::__construct();

		$this->loadLanguageFile('default');
		$this->loadLanguageFile('modules');
	}


	/**
	 * generates the json array of a timeline
	 * @throws \Exception
	 */
	public function run()
	{
		$id = \Input::get('id');

		if($id == '')
		{
			throw new \Exception('No id given');
		}

		$cache = $this->getCached($id);

		if($cache === null)
		{
			echo $this->createCache($id);
		}
		else
		{
			echo $cache;
		}
	}


	/**
	 * @param $id
	 * @return bool
	 */
	public function isCached($id)
	{
		return file_exists(sprintf('%s/system/cache/timelinejs/timeline_%s.json', TL_ROOT, $id));
	}


	/**
	 * create cache entry and return it as string
	 * @param $id
	 * @return string
	 * @throws \Exception
	 */
	public function createCache($id)
	{
		$timeline = \TimelineJSModel::findByPk($id);
		$entries = \TimelineJSEntryModel::findPublishedByPid($id);

		if($timeline === null)
		{
			throw new \Exception('Timeline not found');
		}

		$json = array();
		$json['headline'] = $timeline->title;
		$json['type'] = 'default';
		$json['text'] = $timeline->teaser;
		$json['date'] = array();

		if($timeline->media)
		{
			$json['asset'] = array
			(
				'credit' => $timeline->credit,
				'caption' => $timeline->caption
			);

			if($timeline->singleSRC)
			{
				$objFile = \FilesModel::findByPk($timeline->singleSRC);
				$json['asset']['media'] = $objFile->path;
			}
		}


		if($entries === null)
		{
			echo json_encode($json);
			return;
		}

		while($entries->next()) {
			$entry = array(
				'startDate' => $entries->startDate,
				'endDate' => $entries->endDate ? $entries->endDate : $entries->startDate,
				'headline' => $entries->headline,
				'text' => $entries->teaser,
			);

			if($entries->tags)
			{
				$entry['tag'] = $entries->tags;
			}

			if($entries->era)
			{
				$json['era'][] = $entry;
			}

			if($entries->media)
			{
				$thumbnail = false;

				if($entries->thumbnail)
				{
					$objFile = \FilesModel::findByPk($entries->thumbnail);
					$thumbnail = \Image::get($objFile->path, 60, 60);
				}

				if($entries->singleSRC)
				{
					$objFile = \FilesModel::findByPk($entries->singleSRC);
					$url = $objFile->path;

					if(!$thumbnail)
					{
						$thumbnail = \Image::get($url, 60, 60);
					}
				}
				else
				{
					$url = $entries->url;
				}

				$entry['asset'] = array(
					'media' => $url,
					'credit' => $entries->credit,
					'caption' => $entries->caption,
				);

				if($thumbnail)
				{
					$entry['asset']['thumbnail'] = $thumbnail;
				}
			}

			$json['date'][] = $entry;
		}

		$json = sprintf('{ "timeline": %s }', json_encode($json));
		$cache = new \File(sprintf('system/cache/timelinejs/timeline_%s.json', $id));
		$cache->write($json);

		return $json;
	}


	/**
	 * @param $id
	 * @return string
	 */
	public function getCached($id)
	{
		if($this->isCached($id))
		{
			return file_get_contents(sprintf('%s/system/cache/timelinejs/timeline_%s.json', TL_ROOT, $id));
		}

		return null;
	}


	/**
	 * purge cache directory
	 */
	public function purgeCache()
	{
		if(is_dir(TL_ROOT . '/system/cache/timelinejs'))
		{
			// Purge the folder
			$objFolder = new \Folder('system/cache/timelinejs');
			$objFolder->purge();

			// Restore the .htaccess file
			$objFile = new \File('system/logs/.htaccess', true);
			$objFile->copyTo('system/tmp/.htaccess');

			// Add a log entry
			$this->log('Purged the TimelineJS cache folder', 'TimelineJS\JSONController purgeCache()', TL_CRON);
		}
	}

}