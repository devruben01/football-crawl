<?php

namespace App\Console\Commands;

use App\Constants\Constants;
use App\Jobs\CrawlDataByDateJob;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CrawlDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:xoso-data {--start=} {--end=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'crawl:xoso-data';

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

        $start = $this->option('start');
        $end = $this->option('end');

        $startDate = Carbon::parse($start);
        $endDate = Carbon::parse($end);

        $this->crawlDataByRangeDate($startDate, $endDate);
    }

    private function crawlDataByRangeDate($startDate, $endDate)
    {
        $crawlTimeStart = Carbon::now()->format("Y-m-d H:i:s");
        Log::channel('kqsx_info')->info('Start crawl data: ' . $crawlTimeStart);
        while ($startDate->lte($endDate)) {
            $date = $startDate->format('d-m-Y');
            Log::channel('kqsx_info')->info('Crawl data: ' . $date);

            $listRegionCrawl = Constants::REGIONS_SLUG;
            foreach ($listRegionCrawl as $province) {
                $url = "https://www.minhngoc.net.vn/getkqxs/{$province}/{$date}.js";
                CrawlDataByDateJob::dispatch($startDate, $url, $province)->onQueue('low');
            }
            $startDate->addDay();
        }
        $crawlTimeEnd = Carbon::now()->format("Y-m-d H:i:s");
        Log::channel('kqsx_info')->info('End crawl data: ' . $crawlTimeEnd);
    }
}
