<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Frontend;

use Netzmacht\Contao\TimelineJs\Model\EntryModel;
use Netzmacht\Contao\TimelineJs\Model\TimelineModel;

/**
 * Class JSONController.
 *
 * @package Netzmacht\TimelineJS
 */
class JSONController extends \Frontend
{
    /**
     * The input.
     *
     * @var \Input
     */
    private $input;

    /**
     * Construct.
     *
     * @param \Input $input The input.
     */
    public function __construct(\Input $input)
    {
        parent::__construct();

        $this->loadLanguageFile('default');
        $this->loadLanguageFile('modules');

        $this->input = $input;
    }

    /**
     * Generates the json array of a timeline.
     *
     * @return void
     * @throws \RuntimeException When no id is given.
     */
    public function run()
    {
        $timelineId = \Input::get('id');

        if ($timelineId == '') {
            throw new \RuntimeException('No id given');
        }

        echo $this->createJson($timelineId);
    }

    /**
     * Create cache entry and return it as string.
     *
     * @param int $timelineId The timeline id.
     *
     * @return string
     * @throws \RuntimeException When timeline is not found.
     */
    public function createJson($timelineId)
    {
        $timeline = TimelineModel::findByPk($timelineId);
        $entries  = EntryModel::findPublishedByPid($timelineId);

        if ($timeline === null) {
            throw new \RuntimeException('Timeline not found');
        }

        $json             = array();
        $json['headline'] = $this->replaceInsertTags($timeline->title);
        $json['type']     = 'default';
        $json['text']     = $this->replaceInsertTags($timeline->teaser);
        $json['date']     = array();

        if ($timeline->media) {
            $json['asset'] = array
            (
                'credit'  => $this->replaceInsertTags($timeline->credit),
                'caption' => $this->replaceInsertTags($timeline->caption)
            );

            if ($timeline->singleSRC) {
                $objFile                = \FilesModel::findByPk($timeline->singleSRC);
                $json['asset']['media'] = $objFile->path;
            }
        }

        if ($entries === null) {
            echo json_encode($json);

            return '';
        }

        while ($entries->next()) {
            $this->parseEntry($entries, $json);
        }

        $json = sprintf('{ "timeline": %s }', json_encode($json));

        return $json;
    }

    /**
     * Parse an entry.
     *
     * @param EntryModel $model The entry model.
     * @param array      $json  Generated json representation.
     *
     * @return array
     */
    protected function parseEntry($model, &$json)
    {
        $entry = array(
            'startDate' => $model->startDate,
            'endDate'   => $model->endDate ? $model->endDate : $model->startDate,
            'headline'  => $this->replaceInsertTags($model->headline),
            'text'      => $this->replaceInsertTags($model->teaser),
        );

        if ($model->tags) {
            $entry['tag'] = $model->tags;
        }

        if ($model->era) {
            $json['era'][] = $entry;
        }

        $this->parseMedia($model, $entry);

        $json['date'][] = $entry;

        return $json;
    }

    /**
     * Pars the media section.
     *
     * @param EntryModel $model The entry model.
     * @param array      $entry The parsed entry.
     *
     * @return void
     */
    protected function parseMedia($model, &$entry)
    {
        if ($model->media) {
            $thumbnail = false;

            if ($model->thumbnail) {
                $objFile   = \FilesModel::findByPk($model->thumbnail);
                $thumbnail = \Image::get($objFile->path, 60, 60);
            }

            if ($model->singleSRC) {
                $objFile = \FilesModel::findByPk($model->singleSRC);
                $url     = $objFile->path;

                if (!$thumbnail) {
                    $thumbnail = \Image::get($url, 60, 60);
                }
            } else {
                $url = $this->replaceInsertTags($model->url);
            }

            $entry['asset'] = array(
                'media'   => $url,
                'credit'  => $this->replaceInsertTags($model->credit),
                'caption' => $this->replaceInsertTags($model->caption),
            );

            if ($thumbnail) {
                $entry['asset']['thumbnail'] = $thumbnail;
            }
        }
    }
}
