<?php

namespace App\Console\Commands;

use App\Jobs\CrawlCategoryJob;
use Illuminate\Console\Command;

class CrawlCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:category-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'crawl:category-data';

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
        CrawlCategoryJob::dispatch()->onQueue('low');
    }
}
