<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Dca;

use ContaoCommunityAlliance\Translator\TranslatorInterface as Translator;
use Netzmacht\Contao\TimelineJs\Definition\Date;
use Netzmacht\Contao\TimelineJs\Model\EntryModel;
use Netzmacht\Contao\TimelineJs\Model\TimelineModel;
use Netzmacht\Contao\TimelineJs\TimelineProvider;
use Netzmacht\Contao\Toolkit\Dca\Callback\Callbacks;
use Netzmacht\Contao\Toolkit\Dca\Manager;

/**
 * Timeline data container callbacks.
 *
 * @package Netzmacht\TimelineJS
 */
class EntryCallbacks extends Callbacks
{
    /**
     * Table name.
     *
     * @var string
     */
    protected static $name = 'tl_timelinejs_entry';

    /**
     * Service name.
     *
     * @var string
     */
    protected static $serviceName = 'timelinejs.dca.entries';

    /**
     * Timeline provider.
     *
     * @var TimelineProvider
     */
    private $timelineProvider;

    /**
     * Translator.
     *
     * @var Translator
     */
    private $translator;

    /**
     * EntryCallbacks constructor.
     *
     * @param Manager          $dcaManager       Data container manager.
     * @param TimelineProvider $timelineProvider Timeline provider.
     * @param Translator       $translator       Translator.
     */
    public function __construct(Manager $dcaManager, TimelineProvider $timelineProvider, Translator $translator)
    {
        parent::__construct($dcaManager);

        $this->timelineProvider = $timelineProvider;
        $this->translator       = $translator;
    }

    /**
     * List the row entry.
     *
     * @param array $row Data row.
     *
     * @return string
     */
    public function listEntry($row)
    {
        return sprintf(
            '%s: %s %s',
            $this->getFormatter()->formatValue('type', $row['type']),
            $row['headline'],
            $row['startDate']
        );
    }

    /**
     * Validate the start date.
     *
     * @param mixed $value Date value.
     *
     * @return mixed
     * @throws \InvalidArgumentException On invalid date given.
     */
    public function validateStartDate($value)
    {
        return $this->validateDate($value, true);
    }

    /**
     * Validate the end date.
     *
     * @param mixed $value Date value.
     *
     * @return mixed
     * @throws \InvalidArgumentException On invalid date given.
     */
    public function validateEndDate($value)
    {
        return $this->validateDate($value);
    }

    /**
     * Validate a date format.
     *
     * @param string $value        Date value.
     * @param bool   $yearRequired If true no empty value is accepted.
     *
     * @return string
     * @throws \InvalidArgumentException On invalid date given.
     */
    private function validateDate($value, $yearRequired = false)
    {
        if ($value || $yearRequired) {
            Date::fromString($value);
        }

        return $value;
    }

    /**
     * Get all category options.
     *
     * @param \DataContainer $dataContainer Data container driver.
     *
     * @return array
     */
    public function getCategoryOptions($dataContainer)
    {
        if ($dataContainer->activeRecord) {
            $timeline = TimelineModel::findByPk($dataContainer->activeRecord->pid);
        } else {
            $timeline = TimelineModel::findByPk(CURRENT_ID);
        }

        return deserialize($timeline->categories, true);
    }

    /**
     * Purge the cache for an updated timeline.
     *
     * @param \DataContainer|mixed $dataContainerOrValue Data container driver or value (save_callback).
     * @param \DataContainer       $dataContainer        Data container driver.
     *
     * @return mixed
     */
    public function purgeCache($dataContainerOrValue, $dataContainer = null)
    {
        if (!$dataContainer) {
            $dataContainer = $dataContainerOrValue;
        }

        if ($dataContainer->activeRecord) {
            $timelineId = $dataContainer->activeRecord->pid;
        } else {
            $entry      = EntryModel::findByPk($dataContainer->id);
            $timelineId = $entry->pid;
        }

        $model = $this->timelineProvider->getTimelineModel($timelineId);
        $this->timelineProvider->purgeCache($model);

        return $dataContainerOrValue;
    }
}
