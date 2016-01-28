<?php

/*
 * This file is part of Dosh.
 *
 * (c) Blue Bay Travel <developers@bluebaytravel.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BlueBayTravel\Dosh\Currency;

/**
 * This is the abstract currency class.
 *
 * @author James Brooks <james@bluebaytravel.co.uk>
 */
abstract class AbstractCurrency
{
    /**
     * Returns the currency code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns the precision used for the value.
     *
     * @return int
     */
    public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * Returns the format used for positive amounts.
     *
     * @return string
     */
    public function getPositive()
    {
        return $this->positive;
    }

    /**
     * Returns the format used for negative amounts.
     *
     * @return string
     */
    public function getNegative()
    {
        return $this->negative;
    }

    /**
     * Sets the precision.
     *
     * @param int $precision
     *
     * @return void
     */
    public function setPrecision($precision)
    {
        $this->precision = $precision;
    }

    /**
     * Formats the given value into the currency we're asking for.
     *
     * @param int $value
     *
     * @return string
     */
    public function format($value)
    {
        $format = $value === null || $value >= 0 ? $this->positive : $this->negative;
        $amount = $this->round(abs($value));

        return preg_replace('/\:value/u', $amount, $format);
    }

    /**
     * Rounds the value to the defined precision.
     *
     * @param mixed $value
     *
     * @return string
     */
    protected function round($value)
    {
        return number_format((float) $value, $this->precision);
    }
}
