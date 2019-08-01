<?php

declare(strict_types=1);

namespace Paycats\Sdk;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/paycats.php' => config_path('paycats.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton(Paycats::class, function(){
            return new Paycats(config('paycats'));
        });

        $this->app->alias(Paycats::class, 'paycats');
    }

    public function provides()
    {
        return [Paycats::class, 'paycats'];
    }
}