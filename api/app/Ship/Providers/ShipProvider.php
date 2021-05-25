<?php

namespace App\Ship\Providers;

use App\Ship\Parents\Providers\MainProvider;
use Kalnoy\Nestedset\NestedSetServiceProvider;

/**
 * Class ShipProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ShipProvider extends MainProvider
{

    /**
     * Register any Service Providers on the Ship layer (including third party packages).
     *
     * @var array
     */
    public $serviceProviders = [
        NestedSetServiceProvider::class,
    ];

    /**
     * Register any Alias on the Ship layer (including third party packages).
     *
     * @var  array
     */
    protected $aliases = [
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ...
        parent::boot();
        // ...
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
