<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\CategoryTournament;
use App\Models\Continent;
use App\Models\Tournament;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CrawlCategoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->crawl();
    }


    public function crawl()
    {
        $url = 'https://api.bongdadzo3.com/match/tournament/home/category-list?sport_id=1&app_type=4&app_version=1';
        $response = file_get_contents($url);
        $continentList = json_decode($response, true)['data'];

        foreach ($continentList as $key => $value) {
            $continent = Continent::updateOrCreate(
                ['continent' => $value['continent']],
                [
                    'continent' => $value['continent'],
                    'continent_icon' => $value['continent_icon'],
                ]
            );
            foreach ($value['list'] as $category) {
                Category::updateOrCreate(
                    ['category_id' => $category['category_id']],
                    [
                        'category_id' => $category['category_id'],
                        'category_name' => $category['category_name'],
                        'icon' => $category['icon'],
                        'continent_id' => $continent->id,
                    ]
                );
                $response = file_get_contents("https://api.bongdadzo3.com/match/tournament/home/category-tournament-list?sport_id=1&category_id={$category['category_id']}&app_type=4&app_version=1");
                $categoryTournamentList = json_decode($response, true)['data'];
                foreach ($categoryTournamentList as $key => $value) {
                    Tournament::updateOrCreate(
                        ['tournament_id' => $value['tournament_id']],
                        [
                            'tournament_id' => $value['tournament_id'],
                            'tournament_name' => $value['tournament_name'],
                            'tournament_en_name' => $value['tournament_en_name'],
                            'tournament_url_name' => $value['tournament_url_name'],
                            'category_id' => $category['category_id'],
                        ]
                    );
                    CategoryTournament::updateOrCreate(
                        [
                            'category_id' => $category['category_id'],
                            'tournament_id' => $value['tournament_id'],
                        ],
                        [
                            'category_id' => $category['category_id'],
                            'tournament_id' => $value['tournament_id'],
                        ]
                    );
                }
            }
        }
        return true;
    }
}
