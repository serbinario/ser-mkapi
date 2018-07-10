<?php

namespace Serbinario\Providers;

use Illuminate\Support\ServiceProvider;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use DB;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function($query) {
            Log::info(
                $query->sql,
                $query->bindings,
                $query->time
            );
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->app->register('CrestApps\CodeGenerator\CodeGeneratorServiceProvider');
        }

    }
}
