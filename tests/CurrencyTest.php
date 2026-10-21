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

class CurrencyTest extends AbstractTestCase
{
    public function testEveryCurrencyPreservesItsFormatting()
    {
        foreach ($this->currencies() as $code => $currency) {
            list($class, $positive, $negative) = $currency;
            $bureau = new $class();

            $this->assertSame($code, $bureau->getCode());
            $this->assertSame(2, $bureau->getPrecision());
            $this->assertSame($positive, $bureau->getPositive());
            $this->assertSame($negative, $bureau->getNegative());

            foreach ($this->amounts() as $case) {
                list($value, $precision, $amount, $isNegative) = $case;
                $expected = str_replace(':value', $amount, $isNegative ? $negative : $positive);
                $message = $code.' '.var_export($value, true).' at precision '.$precision;
                $dosh = new Dosh($class, $precision);

                $this->assertSame($expected, $dosh->format($value), $message);
                $bureau->setPrecision($precision);
                $this->assertSame($precision, $bureau->getPrecision());
                $this->assertSame($expected, $bureau->format($value), $message);
            }
        }
    }

    public function testNullFormatsAsZeroWithoutWarningsOrDeprecations()
    {
        set_error_handler(function ($severity, $message, $file, $line) {
            throw new \ErrorException($message, 0, $severity, $file, $line);
        });

        try {
            foreach ($this->currencies() as $currency) {
                foreach ([0, 1, 2, 4] as $precision) {
                    $dosh = new Dosh($currency[0], $precision);
                    $this->assertSame($dosh->format(0), $dosh->format(null));
                }
            }
        } finally {
            restore_error_handler();
        }
    }

    public function testChangingPrecisionIsFluentAndAffectsSubsequentCalls()
    {
        foreach ($this->currencies() as $currency) {
            $dosh = new Dosh($currency[0]);

            foreach ([0 => '1,235', 4 => '1,234.5678', 2 => '1,234.57'] as $precision => $amount) {
                $this->assertSame($dosh, $dosh->setPrecision($precision));
                $this->assertSame(str_replace(':value', $amount, $currency[1]), $dosh->format('1234.5678'));
                $this->assertSame(str_replace(':value', $amount, $currency[2]), $dosh->format('-1234.5678'));
            }
        }
    }

    private function currencies()
    {
        return [
            'GBP' => [Dosh::GBP, '£:value', '-£:value'],
            'USD' => [Dosh::USD, '$:value', '-$:value'],
            'BGN' => [Dosh::BGN, ':value лв', '-:value лв'],
            'JPY' => [Dosh::JPY, '¥:value', '-¥:value'],
            'EUR' => [Dosh::EUR, '€:value', '-€:value'],
        ];
    }

    private function amounts()
    {
        return [
            [null, 2, '0.00', false],
            [0, 2, '0.00', false],
            [0.0, 2, '0.00', false],
            ['0', 2, '0.00', false],
            ['-0', 2, '0.00', false],
            [20, 2, '20.00', false],
            [-20, 2, '20.00', true],
            ['20', 2, '20.00', false],
            ['-20', 2, '20.00', true],
            [12.5, 2, '12.50', false],
            [-12.5, 2, '12.50', true],
            ['12.50', 2, '12.50', false],
            ['-12.50', 2, '12.50', true],
            ['+12.50', 2, '12.50', false],
            ['1e3', 2, '1,000.00', false],
            ['-1e3', 2, '1,000.00', true],
            [1234567.89, 2, '1,234,567.89', false],
            [-1234567.89, 2, '1,234,567.89', true],
            ['1234567.89', 2, '1,234,567.89', false],
            ['-1234567.89', 2, '1,234,567.89', true],
            ['1.004', 2, '1.00', false],
            ['-1.004', 2, '1.00', true],
            ['1.005', 2, '1.01', false],
            ['-1.005', 2, '1.01', true],
            ['999.995', 2, '1,000.00', false],
            ['-999.995', 2, '1,000.00', true],
            ['0.004', 2, '0.00', false],
            ['-0.004', 2, '0.00', true],
            ['0.005', 2, '0.01', false],
            ['-0.005', 2, '0.01', true],
            ['1234.4', 0, '1,234', false],
            ['-1234.4', 0, '1,234', true],
            ['1234.5', 0, '1,235', false],
            ['-1234.5', 0, '1,235', true],
            ['12.25', 1, '12.3', false],
            ['-12.25', 1, '12.3', true],
            ['12.34565', 4, '12.3457', false],
            ['-12.34565', 4, '12.3457', true],
            ['20', 4, '20.0000', false],
            ['-20', 4, '20.0000', true],
            ['1234.5', -1, PHP_VERSION_ID >= 80300 ? '1,230' : '1,235', false],
            ['-1234.5', -1, PHP_VERSION_ID >= 80300 ? '1,230' : '1,235', true],
            ['1234.5', -2, PHP_VERSION_ID >= 80300 ? '1,200' : '1,235', false],
            ['-1234.5', -2, PHP_VERSION_ID >= 80300 ? '1,200' : '1,235', true],
        ];
    }
}
