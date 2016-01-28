<?php

/*
 * This file is part of Dosh.
 *
 * (c) Blue Bay Travel <developers@bluebaytravel.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BlueBayTravel\Dosh;

class Dosh
{
    /**
     * GBP currency.
     *
     * @var string
     */
    const GBP = '\\BlueBayTravel\\Dosh\\Currency\\PoundSterlingCurrency';

    /**
     * USD currency.
     *
     * @var string
     */
    const USD = '\\BlueBayTravel\\Dosh\\Currency\\DollarCurrency';

    /**
     * BGN currency.
     *
     * @var string
     */
    const BGN = '\\BlueBayTravel\\Dosh\\Currency\\BulgarianLevCurrency';

    /**
     * BGN currency.
     *
     * @var string
     */
    const JPY = '\\BlueBayTravel\\Dosh\\Currency\\YenCurrency';

    /**
     * The currency instance.
     *
     * @var \BlueBayTravel\Dosh\Currency\CurrencyInterface
     */
    protected $bureau;

    /**
     * Create a new dosh instance.
     *
     * @param string|null $currency
     * @param int         $precision
     *
     * @return void
     */
    public function __construct($currency = null, $precision = 2)
    {
        if (is_null($currency)) {
            $currency = self::GBP;
        }

        $this->bureau = new $currency();
        $this->bureau->setPrecision($precision);
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
        return $this->bureau->format($value);
    }

    /**
     * Sets the precision to use when formatting.
     *
     * @param int $precision
     *
     * @return void
     */
    public function setPrecision($precision)
    {
        $this->bureau->setPrecision($precision);
    }
}
