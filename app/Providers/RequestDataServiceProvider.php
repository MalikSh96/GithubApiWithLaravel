<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\IRequestData;
use App\Helpers\RequestData;

class RequestDataServiceProvider extends ServiceProvider
{
    //We specify here in RequestDataServiceProvider, that the class of IRequestData interface should be the RequestData class
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // creating a singleton instance of our "helpers" (ie. services)
        $this->app->singleton(IRequestData::class, RequestData::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // $this->app->bind(IRequestData::class, RequestData::class);
    }
}
