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

use Illuminate\Support\ServiceProvider;

class DoshServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerDosh();
    }

    /**
     * Register the phrontmatter class.
     *
     * @return void
     */
    protected function registerDosh()
    {
        $this->app->singleton('dosh', function ($app) {
            return new Dosh();
        });

        $this->app->alias('dosh', Dosh::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'dosh',
        ];
    }
}
