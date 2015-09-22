<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\TimelineJs\Definition;

use Assert\Assertion;
use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Type\ConvertsToJavascript;

/**
 * TimelineJS date object.
 *
 * @package Netzmacht\Contao\TimelineJs\Definition
 */
final class Date implements ConvertsToJavascript
{
    /**
     * The date.
     *
     * @var array
     */
    private $date = array(
        'year'        => null,
        'month'       => null,
        'day'         => null,
        'hour'        => null,
        'minute'      => null,
        'second'      => null,
        'millisecond' => null,
    );

    /**
     * The date format.
     *
     * @var string
     */
    private $format;

    /**
     * The display representation.
     *
     * @var string
     */
    private $display;

    /**
     * Date constructor.
     *
     * @param array  $date    Date as array.
     * @param string $format  Javascript date format.
     * @param string $display Display representation.
     */
    public function __construct(array $date, $format = null, $display = null)
    {
        $this->setDate($date);

        $this->format  = $format;
        $this->display = $display;
    }

    /**
     * Get date from a date time object.
     *
     * @param \DateTime $dateTime The date time object.
     * @param string    $format   Javascript date format.
     * @param string    $display  Display representation.
     *
     * @return static
     */
    public static function fromDateTime(\DateTime $dateTime, $format = null, $display = null)
    {
        $date = array(
            'year'        => $dateTime->format('Y'),
            'month'       => $dateTime->format('n'),
            'day'         => $dateTime->format('d'),
            'hour'        => $dateTime->format('H'),
            'minute'      => $dateTime->format('i'),
            'second'      => $dateTime->format('s'),
            'millisecond' => $dateTime->format('u')
        );

        return new static($date, $format, $display);
    }


    /**
     * Get date from a timestamp.
     *
     * @param int    $timestamp The timestamp.
     * @param string $format    Javascript date format.
     * @param string $display   Display representation.
     *
     * @return static
     */
    public static function fromTimestamp($timestamp, $format = null, $display = null)
    {
        Assertion::integerish($timestamp, 'Timestamp has to be an integer.');

        $dateTime = new \DateTime();
        $dateTime->setTimestamp($timestamp);

        return static::fromDateTime($dateTime, $format, $display);
    }

    /**
     * Set the date.
     *
     * It ignores invalid array keys.
     *
     * @param array $date The date.
     *
     * @return $this
     */
    public function setDate(array $date)
    {
        Assertion::keyExists($date, 'year', 'Year is required.');

        foreach (array_keys($this->date) as $key) {
            if (array_key_exists($key, $date)) {
                $method = 'set' . ucfirst($key);

                $this->$method($date[$key]);
            } else {
                $this->date[$key] = null;
            }
        }

        return $this;
    }

    /**
     * Get date.
     *
     * @return array
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the year of the date.
     *
     * @param int $year The year.
     *
     * @return $this
     */
    public function setYear($year)
    {
        Assertion::integerish($year);

        $this->date['year'] = (int) $year;

        return $this;
    }

    /**
     * Get the year of the date.
     *
     * @return int
     */
    public function getYear()
    {
        return $this->date['year'];
    }

    /**
     * Set the month of the date.
     * 
     * @param int $month The month.
     *
     * @return $this
     */
    public function setMonth($month)
    {
        Assertion::nullOrIntegerish($month);
        Assertion::nullOrRange($month, 1, 12, 'Month has be to between 1 and 12.');

        $this->date['month'] = $this->toInt($month);
        
        return $this;
    }

    /**
     * Get the month of the date.
     * 
     * @return int|null
     */
    public function getMonth()
    {
        return $this->date['month'];
    }

    /**
     * Set the day of the date.
     *
     * @param int $day The day.
     *
     * @return $this
     */
    public function setDay($day)
    {
        Assertion::nullOrIntegerish($day);
        Assertion::nullOrRange($day, 1, 31, 'Day has be to between 1 and 31.');

        $this->date['day'] = $this->toInt($day);

        return $this;
    }

    /**
     * Get the day of the date.
     *
     * @return int|null
     */
    public function getDay()
    {
        return $this->date['day'];
    }

    /**
     * Set the hour of the date.
     *
     * @param int $hour The hour.
     *
     * @return $this
     */
    public function setHour($hour)
    {
        Assertion::nullOrIntegerish($hour);
        Assertion::nullOrRange($hour, 0, 23, 'Hour has be to between 0 and 23.');

        $this->date['hour'] = $this->toInt($hour);

        return $this;
    }

    /**
     * Get the hour of the date.
     *
     * @return int|null
     */
    public function getHour()
    {
        return $this->date['hour'];
    }

    /**
     * Set the minute of the date.
     *
     * @param int $minute The minute.
     *
     * @return $this
     */
    public function setMinute($minute)
    {
        Assertion::nullOrIntegerish($minute);
        Assertion::nullOrRange($minute, 0, 59, 'Minute has be to between 0 and 59.');

        $this->date['minute'] = $this->toInt($minute);

        return $this;
    }

    /**
     * Get the minute of the date.
     *
     * @return int|null
     */
    public function getMinute()
    {
        return $this->date['minute'];
    }

    /**
     * Set the second of the date.
     *
     * @param int $second The second.
     *
     * @return $this
     */
    public function setSecond($second)
    {
        Assertion::nullOrIntegerish($second);
        Assertion::nullOrRange($second, 0, 59, 'Second has be to between 0 and 59.');

        $this->date['second'] = $this->toInt($second);

        return $this;
    }

    /**
     * Get the second of the date.
     *
     * @return int|null
     */
    public function getSecond()
    {
        return $this->date['second'];
    }

    /**
     * Set the millisecond of the date.
     *
     * @param int $millisecond The millisecond.
     *
     * @return $this
     */
    public function setMillisecond($millisecond)
    {
        Assertion::nullOrIntegerish($millisecond);
        Assertion::nullOrRange($millisecond, 0, 999, 'Millisecond has be to between 0 and 999.');

        $this->date['millisecond'] = $this->toInt($millisecond);

        return $this;
    }

    /**
     * Get the millisecond of the date.
     *
     * @return int|null
     */
    public function getMillisecond()
    {
        return $this->date['millisecond'];
    }

    /**
     * Get format.
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set format. The format is the js date format.
     *
     * @param string $format Format.
     *
     * @return $this
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get display.
     *
     * @return string
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * Set display.
     *
     * @param string $display Display.
     *
     * @return $this
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function encode(Encoder $encoder, $flags = null)
    {
        $data                 = $this->date;
        $data['format']       = $this->format;
        $data['display_date'] = $this->display;
        $data                 = array_filter($data);

        return $encoder->encodeArray($data, $flags);
    }

    /**
     * Convert value to int. It accepts null as null value.
     *
     * @param mixed $value Given value.
     *
     * @return int|null
     */
    private function toInt($value)
    {
        if ($value === null) {
            return null;
        }

        return (int) $value;
    }
}