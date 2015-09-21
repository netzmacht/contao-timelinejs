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

use Netzmacht\Contao\Toolkit\Component\Hybrid;
use Netzmacht\Contao\Toolkit\View\Template;

/**
 * Class HybridTimeline.
 */
class HybridTimeline extends Hybrid
{
    const URL_TEMPLATE = '%s%s/system/modules/timelinejs/public/json.php?id=%s';

    /**
     * Template name.
     *
     * @var string
     */
    protected $strTemplate = 'timelinejs';

    /**
     * Hybrid table.
     *
     * @var string
     */
    protected $strTable = 'tl_timelinejs';

    /**
     * Hybrid key.
     *
     * @var string
     */
    protected $strKey = 'timeline';

    /**
     * {@inheritDoc}
     */
    protected function render(Template $template)
    {
        $misc   = deserialize($this->misc, true);
        $source = sprintf(
            static::URL_TEMPLATE,
            $this->getServiceContainer()->getEnvironment()->get('url'),
            $this->getServiceContainer()->getConfig()->get('websitePath'),
            $this->id
        );

        $template
            ->set('source', $source)
            ->set('font', $this->fonts)
            ->set('startAtEnd', var_export(in_array('startAtEnd', $misc), true))
            ->set('hashBookmarks', var_export(in_array('hashBookmarks', $misc), true))
            ->set('debug', in_array('debug', $misc));
    }
}
