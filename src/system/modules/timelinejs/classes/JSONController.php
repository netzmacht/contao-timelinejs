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

		echo $this->createJson($id);
	}


	/**
	 * create cache entry and return it as string
	 * @param $id
	 * @return string
	 * @throws \Exception
	 */
	public function createJson($id)
	{
		$timeline = \TimelineJSModel::findByPk($id);
		$entries  = \TimelineJSEntryModel::findPublishedByPid($id);

		if($timeline === null)
		{
			throw new \Exception('Timeline not found');
		}

		$json = array();
		$json['headline'] = $this->replaceInsertTags($timeline->title);
		$json['type']     = 'default';
		$json['text']     = $this->replaceInsertTags($timeline->teaser);
		$json['date']     = array();

		if($timeline->media)
		{
			$json['asset'] = array
			(
				'credit'  => $this->replaceInsertTags($timeline->credit),
				'caption' => $this->replaceInsertTags($timeline->caption)
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
			return '';
		}

		while($entries->next()) {
			$entry = array(
				'startDate' => $entries->startDate,
				'endDate'   => $entries->endDate ? $entries->endDate : $entries->startDate,
				'headline'  => $this->replaceInsertTags($entries->headline),
				'text'      => $this->replaceInsertTags($entries->teaser),
			);

			if($entries->tags) {
				$entry['tag'] = $entries->tags;
			}

			if($entries->era) {
				$json['era'][] = $entry;
			}

			if($entries->media) {
				$thumbnail = false;

				if($entries->thumbnail) {
					$objFile   = \FilesModel::findByPk($entries->thumbnail);
					$thumbnail = \Image::get($objFile->path, 60, 60);
				}

				if($entries->singleSRC) {
					$objFile = \FilesModel::findByPk($entries->singleSRC);
					$url = $objFile->path;

					if(!$thumbnail)
					{
						$thumbnail = \Image::get($url, 60, 60);
					}
				}
				else {
					$url = $this->replaceInsertTags($entries->url);
				}

				$entry['asset'] = array(
					'media'   => $url,
					'credit'  => $this->replaceInsertTags($entries->credit),
					'caption' => $this->replaceInsertTags($entries->caption),
				);

				if($thumbnail)
				{
					$entry['asset']['thumbnail'] = $thumbnail;
				}
			}

			$json['date'][] = $entry;
		}

		$json = sprintf('{ "timeline": %s }', json_encode($json));
		return $json;
	}
}