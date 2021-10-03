<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\IDataBaseHandler;
use App\Helpers\DataBaseHandler;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //since we will make multiple calls during our request, we use scoped lifetime
        $this->app->scoped(IDataBaseHandler::class, DataBaseHandler::class);
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
