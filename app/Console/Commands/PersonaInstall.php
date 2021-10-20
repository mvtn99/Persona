<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PersonaInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'persona:install {--force : Do not ask for user confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        File::deleteDirectory(public_path('storage/posts'));
        $this->callSilent('storage:link');
        $copySuccess = File::copyDirectory(public_path('img/posts'), public_path('storage/posts'));
        if ($copySuccess) {
            $this->info('Images successfully copied to storage folder.');
        }
        try {
            $this->call('migrate:fresh', [
                '--seed' => true,
                '--force' => true,
            ]);
        } catch (\Exception $e) {
            $this->error($e);
        }
        $this->info('Persona Installed');
    }
}
