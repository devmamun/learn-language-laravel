<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InstallCommand extends Command
{
    protected $signature = 'app:install';
    protected $description = 'Install the application';

    public function handle()
    {
        $this->info('🚀 Starting application installation...');

        // Generate app key if not set
        if (empty(config('app.key'))) {
            $this->info('🔑 Generating app key...');
            $this->call('key:generate');
        }

        // Fresh migrate and seed
        $this->info('🛠️ Running migrations...');
        $this->call('migrate:fresh');

        $this->info('🌱 Running seeders...');
        $this->call('db:seed');

        $this->call('passport:client', [
                    '--personal' => true,
                    '--name' => config('app.name'),
                ]);

        // Generate keys if not exist (optional because passport:install includes this)
        if (
            !file_exists(storage_path('oauth-private.key')) ||
            !file_exists(storage_path('oauth-public.key'))
        ) {
            $this->info('🔐 Generating Passport encryption keys...');
            $this->call('passport:keys');
        }

        // Storage link
        if (!file_exists(public_path('storage'))) {
            $this->info('🔗 Creating storage symlink...');
            $this->call('storage:link');
        }

        // Clear cache
        $this->info('🧹 Clearing application caches...');
        $this->call('cache:clear');
        $this->call('config:clear');
        $this->call('view:clear');
        $this->call('route:clear');

        $this->info('🎉 Installation completed successfully!');
        return Command::SUCCESS;
    }
}
