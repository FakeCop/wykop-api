<?php

namespace FakeCop\WykopClient;

use FakeCop\WykopClient\Console\InstallWykopClient;
use Illuminate\Support\ServiceProvider;

class WykopClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('wykop_client', function ($app) {
            return new WykopClient();
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'wykop-client');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallWykopClient::class,
            ]);

            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('wykop-client.php'),

            ], 'config');
        }
    }
}
