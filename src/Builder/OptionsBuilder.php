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

use Netzmacht\Contao\TimelineJs\Builder\Data\ModelDecorator;
use Netzmacht\Contao\TimelineJs\Builder\Event\BuildTimelineOptionsEvent;
use Netzmacht\Contao\TimelineJs\Util\StringUtil;

/**
 * Class OptionsBuilder build options array.
 *
 * @package Netzmacht\Contao\TimelineJs\Builder
 */
class OptionsBuilder
{
    /**
     * Timeline options definition.
     *
     * @var array
     */
    private static $mapping = array(
        'script_path'        => array('type' => 'string', 'default' => null),
        'height'             => array('type' => 'string', 'default' => null),
        'width'              => array('type' => 'string', 'default' => null),
        'is_embed'           => array('type' => 'bool', 'default' => false),
        'is_full_embed'      => array('type' => 'bool', 'default' => false),
        'hash_bookmark'      => array('type' => 'bool', 'default' => false),
        'default_bg_color'   => array('type' => 'rgb', 'default' => 'ffffff'),
        'scale_factor'       => array('type' => 'int', 'default' => 2),
        'initial_zoom'       => array('type' => 'int', 'default' => null),
        'zoom_sequence'      => array(
            'type'    => 'csv',
            'default' => [0.5, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89]
        ),
        'layout'             => array('type' => 'string', 'default' => 'landscape'),
        'timenav_position'   => array('type' => 'string', 'default' => 'bottom'),
        'base_class'         => array('type' => 'string', 'default' => 'tl-timeline'),
        'start_at_slide'     => array('type' => 'int', 'default' => 0),
        'start_at_end'       => array('type' => 'bool', 'default' => false),
        'relative_date'      => array('type' => 'bool', 'default' => false),
        'use_bc'             => array('type' => 'bool', 'default' => false),
        'duration'           => array('type' => 'int', 'default' => 1000),
        'ease'               => array('type' => 'string', 'default' => 'easeInOutQuint'),
        'dragging'           => array('type' => 'bool', 'default' => true),
        'trackResize'        => array('type' => 'bool', 'default' => true),
        'slide_default_fade' => array('type' => 'string', 'default' => '0%'),
        'language'           => array('type' => 'string', 'default' => 'en'),
        'map_type'           => array('type' => 'string', 'default' => 'stamen:toner-lite'),
        'ga_property_id'     => array('type' => 'string', 'default' => null),
        'track_events'       => array(
            'type'    => 'csv',
            'default' => [
                'back_to_start',
                'nav_next',
                'nav_previous',
                'zoom_in',
                'zoom_out'
            ]
        ),
        'api_key_flickr'     => array('type' => 'string', 'default' => null),
        'sizes'              => array
        (
            'type'    => 'node',
            'options' => array
            (
                'optimal_tick_witdh'               => array('type' => 'int', 'default' => 100),
                'timenav_height'                   => array('type' => 'int', 'default' => 150),
                'timenav_height_percentage'        => array('type' => 'int', 'default' => 25),
                'timenav_mobile_height_percentage' => array('type' => 'int', 'default' => 40),
                'timenav_height_min'               => array('type' => 'int', 'default' => 150),
                'menubar_height'                   => array('type' => 'int', 'default' => 0),
                'skinny_size'                      => array('type' => 'int', 'default' => 650),
                'medium_size'                      => array('type' => 'int', 'default' => 650),
                'marker_height_min'                => array('type' => 'int', 'default' => 150),
                'marker_width_min'                 => array('type' => 'int', 'default' => 100),
                'marker_padding'                   => array('type' => 'int', 'default' => 5),
                'slide_padding_lr'                 => array('type' => 'int', 'default' => 100),
            )
        )
    );

    /**
     * The built options.
     *
     * @var array
     */
    private $options = array();

    /**
     * Handle the build options event.
     *
     * @param BuildTimelineOptionsEvent $event The event.
     */
    public function handleEvent(BuildTimelineOptionsEvent $event)
    {
        $options = $this->build($event->getTimelineModel());
        $event->getOptions()->setOptions($options);
    }

    /**
     * Build the options for the model.
     *
     * @param \Model $model The model.
     *
     * @return array
     */
    public function build(\Model $model)
    {
        $this->options = array();

        $this->buildOptions(new ModelDecorator($model), static::$mapping);

        return $this->options;
    }

    /**
     * Build the options.
     *
     * @param array|\ArrayAccess $data    The data.
     * @param array              $mapping Mapping definition between data and options.
     */
    private function buildOptions($data, array $mapping)
    {
        foreach ($mapping as $key => $config) {
            $method = sprintf('build%sOption', ucfirst($config['type']));
            if (!method_exists($this, $method)) {
                trigger_error(sprintf('Unsupported config type "%s".', $config['type']), E_USER_WARNING);

                continue;
            }

            // Make sure default isset.
            $config['default'] = isset($config['default']) ? $config['default'] : null;

            $value = isset($data[$key]) ? $data[$key] : null;
            $value = call_user_func([$this, $method], $value, $config);

            // Node does not have to be set. Only set non default options.
            if ($config['type'] === 'node' || $value === $config['default']) {
                continue;
            }

            $key                 = StringUtil::camelize($key);
            $this->options[$key] = $value;
        }
    }

    /**
     * Convert option value to int.
     *
     * @param mixed $value  Given value.
     * @param array $config Option config.
     *
     * @return int|null
     */
    private function buildIntOption($value, $config)
    {
        $value = (int) $value;

        if ($config['default'] === null && $value === 0) {
            return null;
        }

        return $value;
    }

    /**
     * Convert option value to string.
     *
     * @param mixed $value  Given value.
     * @param array $config Option config.
     *
     * @return string|null
     */
    private function buildStringOption($value, $config)
    {
        $value = (string) $value;

        if ($config['default'] === null && $value === 0) {
            return null;
        }

        return $value;
    }

    /**
     * Convert option value to boolean.
     *
     * @param mixed $value  Given value.
     * @param array $config Option config.
     *
     * @return bool|null
     */
    private function buildBoolOption($value, $config)
    {
        $value = (bool) $value;

        if ($config['default'] === null && $value === 0) {
            return null;
        }

        return $value;
    }

    /**
     * Build a node option.
     *
     * @param mixed $value  Given value.
     * @param array $config Option config.
     *
     * @return void
     */
    private function buildNodeOption($value, $config)
    {
        $this->buildOptions(deserialize($value, true), $config['options']);
    }

    /**
     * Build a csv option.
     *
     * @param mixed $value  Given value.
     * @param array $config Option config.
     *
     * @return array
     */
    private function buildCsvOption($value, $config)
    {
        if ($config['default'] === null && $value === 0) {
            return null;
        }

        $delimiter = isset($config['delimiter']) ? $config['delimiter'] : ',';

        return explode($delimiter, $value);
    }

    /**
     * Build a node option.
     *
     * @param mixed $value  Given value.
     * @param array $config Option config.
     *
     * @return array|null
     */
    private function buildRgbOption($value, $config)
    {
        if ($config['default'] === null && $value === 0) {
            return null;
        }

        if (substr($value, 0, 1) === '#') {
            $value = substr($value, 1);
        }

        $length = strlen($value);
        $rgb    = array(
            'r' => null,
            'g' => null,
            'b' => null
        );

        switch ($length) {
            case 3:
                list($rgb['r'], $rgb['g'], $rgb['b']) = str_split($value, 1);
                break;

            case 6:
                list($rgb['r'], $rgb['g'], $rgb['b']) = str_split($value, 2);
                break;

            default:
                return null;
        }

        return $rgb;
    }
}
