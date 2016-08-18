<?php

/**
 * Contao TimelineJS.
 *
 * @package   timelinejs
 * @author    David Molineus <http://netzmacht.de>
 * @license   MPL/2.0
 * @copyright 2013-2016 netzmacht David Molineus
 */

namespace Netzmacht\Contao\TimelineJs\Frontend;

use Netzmacht\Contao\TimelineJs\Event\BuildSourceUrlEvent;
use Netzmacht\Contao\TimelineJs\TimelineProvider;
use Netzmacht\Contao\Toolkit\Component\Hybrid;
use ContaoCommunityAlliance\Translator\TranslatorInterface as Translator;
use Database\Result;
use Model\Collection;
use Netzmacht\Contao\TimelineJs\Model\TimelineModel;
use Netzmacht\Contao\Toolkit\Component\Hybrid\AbstractHybrid;
use Netzmacht\Contao\Toolkit\View\Template;
use Netzmacht\Contao\Toolkit\View\Template\TemplateFactory;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class HybridTimeline.
 */
class HybridTimeline extends AbstractHybrid
{
    const URL_TEMPLATE = '%s%s/system/modules/timelinejs/public/json.php?%s';

    /**
     * Template name.
     *
     * @var string
     */
    protected $templateName = 'timelinejs';

    /**
     * Current url.
     * 
     * @var string
     */
    private $url;
    
    /**
     * Website path.
     * 
     * @var string
     */
    private $websitePath;

    /**
     * Timeline.
     * 
     * @var TimelineModel
     */
    private $timeline;

    /**
     * @var TimelineProvider
     */
    private $timelineProvider;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * HybridTimeline constructor.
     *
     * @param Result|\Model|Collection $model           Component model.
     * @param TimelineProvider         $timelineProvider
     * @param TemplateFactory          $templateFactory Template factory.
     * @param Translator               $translator      Translator.
     * @param EventDispatcherInterface $eventDispatcher
     * @param string                   $url             Current url.
     * @param string                   $websitePath     Website path.
     * @param string                   $column          Column name.
     */
    public function __construct(
        $model,
        TimelineProvider $timelineProvider,
        TemplateFactory $templateFactory,
        Translator $translator,
        EventDispatcherInterface $eventDispatcher,
        $url,
        $websitePath,
        $column = 'main'
    ) {
        parent::__construct($model, $templateFactory, $translator, $column);

        $this->url         = $url;
        $this->websitePath = $websitePath;
        $this->timelineProvider = $timelineProvider;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * {@inheritDoc}
     */
    protected function preGenerate()
    {
        try {
            $this->timeline = $this->timelineProvider->getTimelineModel($this->get('timeline'));
        } catch (\Exception $e) {
            // Prevent rendering if no timeline is given.
            $this->setTemplateName('');
        }
    }


    /**
     * Generate.
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE === 'BE') {
            return sprintf('TIMELINE ' . $this->get('timeline'));
        }

        return parent::generate();
    }

    /**
     * {@inheritDoc}
     */
    protected function compile(Template $template)
    {
        if (!$this->timeline) {
            return;
        }

        parent::compile($template);

        $event = new BuildSourceUrlEvent($this->timeline, ['id' => $this->timeline->id]);
        $this->eventDispatcher->dispatch($event::NAME, $event);

        $query  = http_build_query($event->getQuery()->getArrayCopy());
        $source = sprintf(
            static::URL_TEMPLATE,
            $this->url,
            $this->websitePath,
            $query
        );

        $template
            ->set('timeline', $this->timeline)
            ->set('source', $source)
            ->set('provider', $this->timelineProvider);
    }
}
