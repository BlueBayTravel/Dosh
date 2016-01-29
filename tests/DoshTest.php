<?php

/*
 * This file is part of Dosh.
 *
 * (c) Blue Bay Travel <developers@bluebaytravel.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BlueBayTravel\Tests\Dosh;

use BlueBayTravel\Dosh\Dosh;

class DoshTest extends AbstractTestCase
{
    public function testFormatPoundSterlingDefault()
    {
        $this->assertInstanceOf(Dosh::class, $this->app->dosh);
        $this->assertSame('£20.00', $this->app->dosh->format('20'));
    }

    public function testFormatPoundSterlingDefaultLowerPrecision()
    {
        $this->app->dosh->setPrecision(0);

        $this->assertInstanceOf(Dosh::class, $this->app->dosh);
        $this->assertSame('£20', $this->app->dosh->format('20'));
    }

    public function testFormatPoundSterlingDefaultHigherPrecision()
    {
        $this->app->dosh->setPrecision(4);

        $this->assertInstanceOf(Dosh::class, $this->app->dosh);
        $this->assertSame('£20.0000', $this->app->dosh->format('20'));
    }

    public function testFormatPoundSterlingDefaultNegative()
    {
        $this->app->dosh->setPrecision(0);

        $this->assertInstanceOf(Dosh::class, $this->app->dosh);
        $this->assertSame('-£20', $this->app->dosh->format('-20'));
    }

    public function testPoundSterlingInstance()
    {
        $dosh = new Dosh(Dosh::GBP, 2);
        $this->assertSame('£15.00', $dosh->format('15'));
        $this->assertSame('-£15.00', $dosh->format('-15'));
    }

    public function testUnitedStatesDollarInstance()
    {
        $dosh = new Dosh(Dosh::USD, 2);
        $this->assertSame('$12.50', $dosh->format('12.50'));
        $this->assertSame('-$12.50', $dosh->format('-12.50'));
    }

    public function testBulgarianLevInstance()
    {
        $dosh = new Dosh(Dosh::BGN, 2);
        $this->assertSame('12.50 лв', $dosh->format('12.50'));
        $this->assertSame('-12.50 лв', $dosh->format('-12.50'));
    }

    public function testYenCurrencyInstance()
    {
        $dosh = new Dosh(Dosh::JPY, 2);
        $this->assertSame('¥150.00', $dosh->format('150'));
        $this->assertSame('-¥150.00', $dosh->format('-150'));
    }

    public function testEuroCurrencyInstance()
    {
        $dosh = new Dosh(Dosh::EUR, 2);
        $this->assertSame('€220.00', $dosh->format('220'));
        $this->assertSame('-€220.00', $dosh->format('-220'));
    }
}
