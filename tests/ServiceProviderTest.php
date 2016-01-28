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
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;

class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testDoshIsInjectable()
    {
        $this->assertIsInjectable(Dosh::class);
    }
}
