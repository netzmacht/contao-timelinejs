<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
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
use Netzmacht\Contao\Toolkit\InsertTag\Replacer;

/**
 * Class EntryBuilder build the different definition classes from the entry model.
 *
 * @package Netzmacht\Contao\TimelineJs\Builder
 */
class EntryBuilder
{
    /**
     * Insert tag replacer.
     *
     * @var Replacer
     */
    private $insertTagReplacer;

    /**
     * EntryBuilder constructor.
     *
     * @param Replacer $insertTagReplacer Insert tag replacer.
     */
    public function __construct(Replacer $insertTagReplacer)
    {
        $this->insertTagReplacer = $insertTagReplacer;
    }

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
                $slide = $this->buildTitle($entryModel, $timelineModel);
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
     * Build the title.
     *
     * @param EntryModel    $entryModel    The entry.
     * @param TimelineModel $timelineModel The timeline.
     *
     * @return Slide
     */
    public function buildTitle(EntryModel $entryModel, TimelineModel $timelineModel)
    {
        $text       = $this->buildText($entryModel);
        $media      = $this->buildMedia($entryModel, $timelineModel->thumbnailSize);
        $background = $this->buildBackground($entryModel);
        $display    = $entryModel->dateDisplay ?: null;
        $autolink   = (bool) $entryModel->autolink;

        $slide = new Slide(null, $text, null, $media, null, $background, $display, $autolink);
        $slide->setUniqueId($entryModel->getTable() . '_' . $entryModel->id);

        return $slide;
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
        $group      = $entryModel->category ?: null;
        $background = $this->buildBackground($entryModel);
        $display    = $entryModel->dateDisplay ?: null;
        $autolink   = (bool) $entryModel->autolink;

        $slide = new Slide($startDate, $text, $endDate, $media, $group, $background, $display, $autolink);
        $slide->setUniqueId($entryModel->getTable() . '_' . $entryModel->id);

        return $slide;
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
        $startDate = $this->buildDate($entryModel->startDate);
        $endDate   = $this->buildDate($entryModel->endDate);
        $text      = $this->buildText($entryModel);

        $era = new Era($startDate, $text, $endDate);
        $era->setUniqueId($entryModel->getTable() . '_' . $entryModel->id);

        return $era;
    }

    /**
     * Create the media object for the model. If no url is given, it returns null.
     *
     * @param EntryModel $model         The model.
     * @param mixed      $thumbnailSize The thumbnail size as array or serialized string.
     *
     * @return Media|null
     */
    public function buildMedia(EntryModel $model, $thumbnailSize = null)
    {
        $data = $this->getMediaData($model);
        if (!$data) {
            return null;
        }

        $media = new Media($data);
        $media->setCaption($this->valueOrNull($model->mediaCaption));
        $media->setCredit($this->valueOrNull($model->mediaCredit));

        $this->buildMediaThumbnail($media, $model, $thumbnailSize);

        $link = $this->replaceInsertTags($model->mediaLink);
        if ($link) {
            $media->setLink($link, $this->valueOrNull($model->mediaLinkTarget));
        }

        return $media;
    }

    /**
     * Build the date definition from a string representation.
     *
     * The expected date format is Y-m-d H:i:s.u but only the year is required.
     *
     * @param string      $dateString The date string.
     * @param string|null $format     Alternative date format.
     * @param string|null $display    Date string representation.
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
                $this->replaceInsertTags($entryModel->headline) ?: null,
                $this->replaceInsertTags($entryModel->text) ?: null
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
        $background = $this->replaceInsertTags($entryModel->background);
        if (!$background) {
            return null;
        }

        if (substr($background, 0, 1) === '#') {
            return new BackgroundColor($background);
        }

        return new BackgroundUrl($background);
    }

    /**
     * Replace insert tags.
     *
     * @param string $content Content to replace.
     *
     * @return string
     */
    private function replaceInsertTags($content)
    {
        $content = $this->insertTagReplacer->replace($content);
        $content = $this->insertTagReplacer->replace($content, false);
        
        return $content;
    }

    /**
     * Build media thumbnail.
     *
     * @param Media      $media         Media.
     * @param EntryModel $model         Entry model.
     * @param mixed      $thumbnailSize The thumbnail size as array or serialized string.
     *
     * @return void
     */
    private function buildMediaThumbnail(Media $media, EntryModel $model, $thumbnailSize)
    {
        $thumbnail = $this->replaceInsertTags($model->mediaThumbnail);
        if (!$thumbnail) {
            if (!$model->mediaUrl) {
                return;
            }

            $thumbnail = $this->replaceInsertTags($model->mediaUrl);
            if (!$thumbnail) {
                return;
            }
        }

        if ($thumbnailSize && file_exists(TL_ROOT . '/' . $thumbnail)) {
            $file          = new \File($thumbnail);
            $thumbnailSize = deserialize($thumbnailSize, true);

            if (!in_array($file->extension, ['jpg', 'gif', 'png', 'jpeg'])) {
                return;
            }

            $thumbnail = \Image::get($file, $thumbnailSize[0], $thumbnailSize[1], $thumbnailSize[2]);
        }

        $media->setThumbnail($thumbnail);
    }

    /**
     * Get the media data.
     *
     * @param EntryModel $model Entry model.
     *
     * @return mixed|null|string
     */
    private function getMediaData(EntryModel $model)
    {
        if (!$model->media) {
            return null;
        }

        if ($model->media === 'quote') {
            $data = '<blockquote>' . $model->mediaQuote . '</blockquote>';
        } elseif ($model->media === 'iframe') {
            $data = '<iframe src="' . $model->mediaUrl . '"></iframe>';
        } else {
            $data = $model->mediaUrl;
        }

        return $this->replaceInsertTags($data);
    }

    /**
     * Get the value or null.
     *
     * @param mixed $value Given value.
     *
     * @return mixed
     */
    private function valueOrNull($value)
    {
        return $value ?: null;
    }
}
