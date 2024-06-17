<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RetryFailedJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:retry-failed-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retry all failed jobs';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('queue:retry', ['id' => 'all']);
    }
}
