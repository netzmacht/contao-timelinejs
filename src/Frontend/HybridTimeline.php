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

use ContaoCommunityAlliance\Translator\TranslatorInterface as Translator;
use Database\Result;
use Model\Collection;
use Netzmacht\Contao\TimelineJs\Model\TimelineModel;
use Netzmacht\Contao\Toolkit\Component\Hybrid\AbstractHybrid;
use Netzmacht\Contao\Toolkit\View\Template;
use Netzmacht\Contao\Toolkit\View\Template\TemplateFactory;

/**
 * Class HybridTimeline.
 */
class HybridTimeline extends AbstractHybrid
{
    const URL_TEMPLATE = '%s%s/system/modules/timelinejs/public/json.php?id=%s';

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
    private $timeLine;

    /**
     * HybridTimeline constructor.
     *
     * @param Result|\Model|Collection $model           Component model.
     * @param TemplateFactory          $templateFactory Template factory.
     * @param Translator               $translator      Translator.
     * @param string                   $url             Current url.
     * @param string                   $websitePath     Website path.
     * @param string                   $column          Column name.
     */
    public function __construct(
        $model,
        TemplateFactory $templateFactory,
        Translator $translator,
        $url,
        $websitePath,
        $column = 'main'
    ) {
        parent::__construct($model, $templateFactory, $translator, $column);

        $this->url         = $url;
        $this->websitePath = $websitePath;
    }

    /**
     * {@inheritDoc}
     */
    protected function preGenerate()
    {
        $this->timeLine = TimelineModel::findByPk($this->get('timeline'));

        // Prevent rendering if no timeline is given.
        if (!$this->timeLine) {
            $this->setTemplateName('');
        }
    }
    
    /**
     * {@inheritDoc}
     */
    protected function compile(Template $template)
    {
        if (!$this->timeLine) {
            return;
        }

        parent::compile($template);

        $misc   = deserialize($this->timeLine->misc, true);
        $source = sprintf(
            static::URL_TEMPLATE,
            $this->url,
            $this->websitePath,
            $this->get('timeline')
        );

        $template
            ->set('timeline', $this->timeLine)
            ->set('source', $source)
            ->set('font', $this->timeLine->fonts)
            ->set('startAtEnd', var_export(in_array('startAtEnd', $misc), true))
            ->set('hashBookmarks', var_export(in_array('hashBookmarks', $misc), true))
            ->set('debug', in_array('debug', $misc));
    }
}
