<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package   timelinejs
 * @author    David Molineus <david.molineus@netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Dca;

use ContaoCommunityAlliance\Translator\TranslatorInterface as Translator;
use Netzmacht\Contao\TimelineJs\Model\TimelineModel;
use Netzmacht\Contao\Toolkit\Dca\Options\OptionsBuilder;

/**
 * HybridCallbacks is the data container helper for tl_content and tl_module.
 */
class ComponentCallbacks
{
    /**
     * Translator.
     *
     * @var Translator
     */
    private $translator;

    /**
     * HybridCallbacks constructor.
     *
     * @param Translator $translator Translator.
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Get all timelines as array.
     *
     * @return array
     */
    public function getTimelineOptions()
    {
        $collection = TimelineModel::findAll(['order' => 'title']);

        return OptionsBuilder::fromCollection($collection, 'title')->getOptions();
    }

    /**
     * Add timeline edit button as wizard.
     *
     * @param \DataContainer $dataContainer Data container driver.
     *
     * @return string
     */
    public function getTimelineEditButton($dataContainer)
    {
        if ($dataContainer->activeRecord->timeline == 0) {
            return '';
        }

        $url = \Backend::addToUrl(
            'do=timelinejs&amp;table=tl_timelinejs_entry&amp;act=&amp;id=' . $dataContainer->activeRecord->timeline
        );

        return sprintf(
            '<a href="%s" title="%s"><img src="%s" alt="%s" style="padding-left:5px"></a>',
            $url,
            'system/themes/default/images/edit.gif',
            $this->translator->translate(
                'timeline_edit.1',
                $dataContainer->table,
                [$dataContainer->activeRecord->timeline]
            ),
            $this->translator->translate('timeline_edit.0', $dataContainer->table)
        );
    }
}
