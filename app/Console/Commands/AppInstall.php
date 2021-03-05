<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alboukam:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installing APP';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Installing Alboukam APP');

        $this->info('Migrating data');
        $this->call('migrate:fresh');
        $this->info('Seeding data');
        $this->call('db:seed');
        $this->info('Indexing data');
        $this->call('optimize:clear');
        $this->info('Application Installed');
    }
}
