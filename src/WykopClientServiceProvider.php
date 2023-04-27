<?php

namespace FakeCop\WykopClient;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class WykopClientServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('wykop-client')
            ->hasConfigFile()
            ->hasInstallCommand(function (InstallCommand $command) {
                $command->publishConfigFile()
                    ->copyAndRegisterServiceProviderInApp();
            });
    }

    public function register()
    {
        parent::register();

        $this->app->bind('wykop_client', function () {
            return new WykopClient();
        });
    }
}
