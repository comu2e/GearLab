<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//Query Builder
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Gear\GearDataAccessRepositoryInterface::class,
            \App\Repositories\Gear\GearDataAccessEQRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
