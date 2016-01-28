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

use BlueBayTravel\Dosh\Facades\Dosh as DoshFacade;
use BlueBayTravel\Dosh\Dosh;
use BlueBayTravel\Tests\Dosh\AbstractTestCase;
use GrahamCampbell\TestBenchCore\FacadeTrait;

class DoshTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'dosh';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return DoshFacade::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return Dosh::class;
    }
}
