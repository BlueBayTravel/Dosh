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
use BlueBayTravel\Dosh\DoshServiceProvider;
use Illuminate\Support\ServiceProvider;

class ServiceProviderTest extends AbstractTestCase
{
    public function testIsAServiceProvider()
    {
        $this->assertInstanceOf(ServiceProvider::class, new DoshServiceProvider($this->app));
    }

    public function testProvides()
    {
        $provider = new DoshServiceProvider($this->app);

        $this->assertSame(['dosh'], $provider->provides());
    }

    public function testDoshIsInjectable()
    {
        $this->assertIsInjectable(Dosh::class);
    }

    public function testProviderRegistersOneFormatterForBothBindings()
    {
        $this->assertTrue($this->app->bound('dosh'));
        $this->assertSame($this->app->make('dosh'), $this->app->make('dosh'));
        $this->assertSame($this->app->make('dosh'), $this->app->make(Dosh::class));
        $this->assertSame('£0.00', $this->app->make(Dosh::class)->format(null));
    }

    public function testDoshIsInjectedIntoAConsumer()
    {
        $consumer = $this->app->make(DoshConsumer::class);

        $this->assertSame($this->app->make('dosh'), $consumer->dosh);
        $this->assertSame('£1,234.50', $consumer->dosh->format('1234.50'));
    }
}

class DoshConsumer
{
    public $dosh;

    public function __construct(Dosh $dosh)
    {
        $this->dosh = $dosh;
    }
}
