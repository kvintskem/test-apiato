<?php

namespace App\Containers\Enterprise\Providers;

use App\Ship\Parents\Providers\MainProvider;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 */
class MainServiceProvider extends MainProvider
{
    public $serviceProviders = [];


    public $aliases = [];

    /**
     * Register anything in the container.
     */
    public function register()
    {
        parent::register();
    }
}
