<?php

namespace App\Providers;

use App\Http\Controllers\ItinerariesController;
use App\Http\Controllers\PackagesController;
use App\Interfaces\ModelInterface;
use App\Itinerary;
use App\Package;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->when(PackagesController::class)
            ->needs(ModelInterface::class)
            ->give(function () {
                return new Package();
            });

        $this->app->when(ItinerariesController::class)
            ->needs(ModelInterface::class)
            ->give(function () {
                return new Itinerary();
            });
    }
}
