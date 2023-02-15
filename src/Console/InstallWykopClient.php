<?php

namespace FakeCop\WykopClient\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallWykopClient extends Command
{
    protected $signature = 'wykop-client:install';

    protected $description = 'Install WykopClient package';

    public function handle()
    {
        $this->info('Installing WykopClient ...');

        $this->info('Publish configuration ...');

        if (!$this->configExists('wykop-client.php')) {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting configuration file ...');
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing configuration wa not overwritten');
            }
        }

        $this->info('Installed WykopClient');
    }

    private function configExists(string $fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "FakeCop\\WykopClient\\WykopClientServiceProvider",
            '--tag' => 'config'
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}
