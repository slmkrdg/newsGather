<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\News;
use App\Models\Coin;
use Illuminate\Console\Command;
use App\Services\News\Factory\NewsServiceFactory;

class FetchNews extends Command
{
    protected $signature = 'news:fetch';
    protected $description = 'Fetch news from the external source';
    protected NewsServiceFactory $factory;

    public function __construct(NewsServiceFactory $factory)
    {
        parent::__construct();
        $this->factory = $factory;
    }

    public function handle()
    {

        $serviceName = 'cryptopanic'; 

        $newsService = $this->factory->create($serviceName);
        $news = $newsService->fetchNews();
        
        foreach ($news['results'] as $item) {

            $news = News::updateOrCreate(
                ['news_id' => $item['id']],
                [
                    'news_id'       => $item['id'],
                    'title'         => $item['title'],
                    'published_at'  => Carbon::createFromFormat('Y-m-d\TH:i:s\Z',$item['published_at'])->format('Y-m-d H:i:s'),
                    'driver'        => $serviceName,
                    'created_at'    => Carbon::createFromFormat('Y-m-d\TH:i:s\Z',$item['created_at'])->format('Y-m-d H:i:s'),
                ]
            );

            if(isset($item['currencies'])){
                foreach ($item['currencies'] as $currencyData) {
                    Coin::create(
                        [
                            'news_id' => $news->id,
                            'name'    => $currencyData['title'],
                            'code'    => $currencyData['code'],
                        ]
                    );
                }
            }
        }

    }
}
