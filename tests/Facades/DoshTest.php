<?php

/*
 * This file is part of Dosh.
 *
 * (c) Blue Bay Travel <developers@bluebaytravel.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BlueBayTravel\Tests\Dosh\Facades;

use BlueBayTravel\Dosh\Dosh;
use BlueBayTravel\Dosh\Facades\Dosh as DoshFacade;
use BlueBayTravel\Tests\Dosh\AbstractTestCase;
use Illuminate\Support\Facades\Facade;

class DoshTest extends AbstractTestCase
{
    public function testFacadeUsesTheRegisteredSingleton()
    {
        $this->assertSame($this->app->make('dosh'), DoshFacade::getFacadeRoot());
        $this->assertSame('£0.00', DoshFacade::format(null));
        $this->assertSame('-£1,234.50', DoshFacade::format('-1234.50'));
        $this->assertSame($this->app->make('dosh'), DoshFacade::setPrecision(0));
        $this->assertSame('£1,235', $this->app->make(Dosh::class)->format('1234.5'));
    }

    public function testIsAFacade()
    {
        $this->assertTrue(is_subclass_of(DoshFacade::class, Facade::class));
    }

    public function testFacadeRoot()
    {
        $this->assertInstanceOf(Dosh::class, DoshFacade::getFacadeRoot());
    }
}
