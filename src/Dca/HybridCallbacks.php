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

namespace Netzmacht\Contao\TimelineJs\Dca;

use Netzmacht\Contao\TimelineJs\Model\TimelineModel;
use Netzmacht\Contao\Toolkit\Dca\Options\OptionsBuilder;
use Netzmacht\Contao\Toolkit\ServiceContainerTrait;

/**
 * HybridCallbacks is the data container helper for tl_content and tl_module.
 */
class HybridCallbacks extends \System
{
    use ServiceContainerTrait;

    /**
     * Get all timelines as array.
     *
     * @return array
     */
    public function getTimelineOptions()
    {
        $collection = TimelineModel::findAll();

        return OptionsBuilder::fromCollection($collection, 'id', 'title')->getOptions();
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

        $translator = $this->getServiceContainer()->getTranslator();
        $table      = $this->getServiceContainer()->getInput()->get('table');
        $url        = \Backend::addToUrl(
            'do=timelinejs&amp;table=tl_timelinejs_entry&amp;act=&amp;id=' . $dataContainer->activeRecord->timeline
        );

        return sprintf(
            '<a href="%s" title="%s"><img src="%s" alt="%s" style="padding-left:5px"></a>',
            $url,
            'system/themes/default/images/edit.gif',
            $translator->translate('timeline_edit.1', $table, [$dataContainer->activeRecord->timeline]),
            $translator->translate('timeline_edit.0', $table)
        );
    }
}
