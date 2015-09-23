<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Builder;

use Netzmacht\Contao\TimelineJs\Builder\Event\BuildEntryEvent;
use Netzmacht\Contao\TimelineJs\Definition\Background;
use Netzmacht\Contao\TimelineJs\Definition\Background\BackgroundColor;
use Netzmacht\Contao\TimelineJs\Definition\Background\BackgroundUrl;
use Netzmacht\Contao\TimelineJs\Definition\Date;
use Netzmacht\Contao\TimelineJs\Definition\Era;
use Netzmacht\Contao\TimelineJs\Definition\Media;
use Netzmacht\Contao\TimelineJs\Definition\Slide;
use Netzmacht\Contao\TimelineJs\Definition\Text;
use Netzmacht\Contao\TimelineJs\Model\EntryModel;
use Netzmacht\Contao\TimelineJs\Model\TimelineModel;
use Netzmacht\Contao\TimelineJs\Util\StringUtil;

/**
 * Class EntryBuilder build the different definition classes from the entry model.
 *
 * @package Netzmacht\Contao\TimelineJs\Builder
 */
class EntryBuilder
{
    /**
     * Handle the build event.
     *
     * @param BuildEntryEvent $event The event.
     *
     * @return void
     */
    public function handleEvent(BuildEntryEvent $event)
    {
        if ($event->hasResult()) {
            return;
        }

        $entryModel    = $event->getEntryModel();
        $timelineModel = $event->getTimelineModel();

        switch ($entryModel->type) {
            case 'title':
                $slide = $this->buildSlide($entryModel, $timelineModel);
                $event->setTitle($slide);
                break;

            case '':
            case 'event':
                $slide = $this->buildSlide($entryModel, $timelineModel);
                $event->setSlide($slide);
                break;

            case 'era':
                $era = $this->buildEra($entryModel);
                $event->setEra($era);
                break;

            default:
                // Do nothing
        }
    }

    /**
     * Build the slide.
     *
     * @param EntryModel    $entryModel    The entry.
     * @param TimelineModel $timelineModel The timeline.
     *
     * @return Slide
     */
    public function buildSlide(EntryModel $entryModel, TimelineModel $timelineModel)
    {
        $startDate  = $this->buildDate($entryModel->startDate, $entryModel->dateFormat, $entryModel->startDisplay);
        $endDate    = $this->buildDate($entryModel->endDate, $entryModel->dateFormat, $entryModel->endDisplay);
        $text       = $this->buildText($entryModel);
        $media      = $this->buildMedia($entryModel, $timelineModel->thumbnailSize);
        $group      = $entryModel->type === 'title' ? null : ($entryModel->category ?: null);
        $background = $this->buildBackground($entryModel);
        $display    = $entryModel->dateDisplay ?: null;
        $autolink   = (bool) $entryModel->autolink;

        return new Slide($startDate, $text, $endDate, $media, $group, $background, $display, $autolink);
    }

    /**
     * Build an era.
     *
     * @param EntryModel $entryModel The entry.
     *
     * @return Era
     */
    public function buildEra(EntryModel $entryModel)
    {
        $startDate  = $this->buildDate($entryModel->startDate, $entryModel->dateFormat, $entryModel->startDisplay);
        $endDate    = $this->buildDate($entryModel->endDate, $entryModel->dateFormat, $entryModel->endDisplay);
        $text       = $this->buildText($entryModel);

        return new Era($startDate, $text, $endDate);
    }

    /**
     * Create the media object for the model. If no url is given, it returns null.
     *
     * @param EntryModel $model The model.
     *
     * @param mixed  $thumbnailSize The thumbnail size as array or serialized string.
     *
     * @return Media|null
     */
    public function buildMedia(EntryModel $model, $thumbnailSize = null)
    {
        $url = StringUtil::replaceInsertTags($model->mediaUrl);

        if (!$url) {
            return null;
        }

        $media = new Media($url);
        $media->setCaption($model->mediaCaption ?: null);
        $media->setCredit($model->mediaCredit ?: null);

        $thumbnail = StringUtil::replaceInsertTags($model->mediaThumbnail);
        if ($thumbnail) {
            $media->setThumbnail($thumbnail);
        } elseif ($thumbnailSize && file_exists(TL_ROOT . '/' . $url)) {
            $file          = new \File($url);
            $thumbnailSize = deserialize($thumbnailSize, true);

            if (in_array($file->extension, ['jpg', 'gif', 'png', 'jpeg'])) {
                $thumbnail = \Image::get($file, $thumbnailSize[0], $thumbnailSize[1], $thumbnailSize[2]);
                $media->setThumbnail($thumbnail);
            }
        }

        return $media;
    }

    /**
     * Build the date definition from a string representation.
     *
     * The expected date format is Y-m-d H:i:s.u but only the year is required.
     *
     * @param string        $dateString The date string.
     * @param string|null   $format     Alternative date format.
     * @param string|null   $display    Date string representation.
     *
     * @return Date|null
     */
    public function buildDate($dateString, $format = null, $display = null)
    {
        $format  = $format ?: null;
        $display = $display ?: null;

        if ($dateString) {
            return Date::fromString($dateString, $format, $display);
        }

        return null;
    }

    /**
     * Build the text object for the entry. Returns null if headline and text are not set.
     *
     * @param EntryModel $entryModel The entry.
     *
     * @return Text|null
     */
    public function buildText(EntryModel $entryModel)
    {
        if ($entryModel->headline || $entryModel->text) {
            return new Text(
                StringUtil::replaceInsertTags($entryModel->headline) ?: null,
                StringUtil::replaceInsertTags($entryModel->text) ?: null
            );
        }

        return null;
    }

    /**
     * Build the entry.
     *
     * @param EntryModel $entryModel The entry.
     *
     * @return Background|null
     */
    public function buildBackground(EntryModel $entryModel)
    {
        $background = deserialize($entryModel->background, true);

        switch ($background[1]) {
            case 'url':
                return new BackgroundUrl(StringUtil::replaceInsertTags($background[0]));

            case 'color':
                return new BackgroundColor($background[0]);

            default:
                return null;
        }
    }
}
