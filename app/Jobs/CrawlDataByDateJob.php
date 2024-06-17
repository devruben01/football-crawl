<?php

namespace App\Jobs;

use App\Constants\Constants;
use App\Models\Kqsx;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class CrawlDataByDateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $date;
    protected $url;
    protected $province;
    /**
     * Create a new job instance.
     */
    public function __construct($date, $url, $province)
    {
        $this->date = $date;
        $this->url = $url;
        $this->province = $province;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->crawlData($this->date, $this->url, $this->province);
        } catch (\Throwable $th) {
            Log::channel('kqsx_error')->error($th->getMessage());
            throw $th;
        }
    }


    public function crawlData($date, string $url = "", string $province = 'mien-bac')
    {
        try {
            $date = $date->format('d/m/Y');
            $response = file_get_contents($url);
            $crawler = new Crawler($response);
            $html = $crawler->text();

            $pattern = '/KQXS (.*?) Giải ĐB (.*?) \'\)\;/';            

            $result = null;

            if (preg_match($pattern, $html, $matches)) {
                $text  = $matches[0];
                if (empty($text)) {
                    return false;
                }
                $result = $this->extractResults($text);
                $region = $this->getRegion($province, Constants::REGION_IDS);

                $result['province'] = $province;
                $result['region'] = $region;
                $result['run'] = 0;
            }

            if (!empty($result)) {
                if ($result['date'] != $date) return false;
                $result['date'] = Carbon::createFromFormat('d/m/Y', $result['date'])->startOfDay();
                Kqsx::updateOrCreate(
                    [
                        'date' => $result['date'],
                        'province' => $result['province']
                    ],
                    $result
                );
            }
            return false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    private function getRegion($input, $mienId)
    {
        foreach ($mienId as $region => $cities) {
            if (in_array($input, $cities)) {
                return $region;
            }
        }
        return null;
    }

    private function extractResults($text)
    {
        $results = array();
        if (preg_match('/(\d{2}\/\d{2}\/\d{4})/', $text, $dateMatch)) {
            $date = $dateMatch[1];
        } else {
            $date = null;
        }

        preg_match_all('/Giải\s([^\d]+)\s(\d+(?:\s*-\s*\d+)*)/', $text, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $name = trim($match[1]);
            $values = explode(' - ', $match[2]);
            $results[] = array("name" => "Giải " . $name, "value" => $values);
        }

        return array("date" => $date, "result" => $results);
    }
}
