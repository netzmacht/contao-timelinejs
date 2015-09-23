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

use Netzmacht\Contao\TimelineJs\Event\BuildSourceUrlEvent;
use Netzmacht\Contao\TimelineJs\TimelineProvider;
use Netzmacht\Contao\Toolkit\Component\Hybrid;
use Netzmacht\Contao\Toolkit\View\Template;

/**
 * Class HybridTimeline.
 */
class HybridTimeline extends Hybrid
{
    const URL_TEMPLATE = '%s%s/system/modules/timelinejs/public/json.php?%s';

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
     * Get the timeline provider.
     *
     * @return TimelineProvider
     */
    private function getTimelineProvider()
    {
        return $this->getServiceContainer()->getService('timelinejs.provider');
    }

    /**
     * Generate.
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE === 'BE') {
            return sprintf('TIMELINE ' . $this->objParent->timeline);
        }

        return parent::generate();
    }

    /**
     * {@inheritDoc}
     */
    protected function render(Template $template)
    {
        $provider = $this->getTimelineProvider();
        $timeline = $provider->getTimelineModel($this->objParent->timeline);
        $event    = new BuildSourceUrlEvent($timeline, ['id' => $timeline->id]);

        $this->getServiceContainer()->getEventDispatcher()->dispatch($event::NAME, $event);

        $query  = http_build_query($event->getQuery()->getArrayCopy());
        $source = sprintf(
            static::URL_TEMPLATE,
            $this->getServiceContainer()->getEnvironment()->get('url'),
            $this->getServiceContainer()->getConfig()->get('websitePath'),
            $query
        );

        $template
            ->set('source', $source)
            ->set('timeline', $timeline)
            ->set('provider', $provider);
    }
}
