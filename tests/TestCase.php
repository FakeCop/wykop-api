<?php

namespace FakeCop\WykopClient\Tests;

use FakeCop\WykopClient\WykopClientServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        //$this->loadLaravelMigrations(['--database' => 'testbench']);
        //$this->artisan('migrate', ['--database' => 'testbench'])->run();

        $this->artisan('wykop-client:install')->run();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            WykopClientServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}