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
 * This is the dollar currency class.
 *
 * @author James Brooks <james@bluebaytravel.co.uk>
 */
class DollarCurrency extends AbstractCurrency implements CurrencyInterface
{
    /**
     * The currency code.
     *
     * @var string
     */
    protected $code = 'USD';

    /**
     * The precision used for the value.
     *
     * @var int
     */
    protected $precision = 2;

    /**
     * The format used for positive amounts.
     *
     * @var string
     */
    protected $positive = '$:value';

    /**
     * The format used for negative amounts.
     *
     * @var string
     */
    protected $negative = '-$:value';
}
