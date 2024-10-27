<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\Coin;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\NewsFilterRequest;
use App\Services\News\Factory\NewsServiceFactory;

class NewsController extends Controller
{
    protected NewsServiceFactory $factory;

    public function __construct(NewsServiceFactory $factory)
    {
        $this->factory = $factory;
    }

    public function index() {
        $coins = Coin::all()->groupBy('code')->map(function ($group) {
            return $group->first(); // Her gruptan ilk elemanı al
        });
        return view('news.index', compact('coins'));
    }
    
    public function filter(NewsFilterRequest $request) {
        $query = Cache::remember('news_all', 60 * 60, function () {
            return News::query();
        });
        
        $query = News::query();

        // Coin Seçimi (Select Input)
        if ($request->has('coin') && !empty($request->coin)) {
            $query->whereHas('coins', function($q) use ($request) {
                $q->where('code', $request->coin);  // Coin koduna göre filtreleme
            });
        }

        // Tarih Filtreleme
        if ($request->has('start_date') && !empty($request->start_date)) {
            $query->where('published_at', '>=', $request->start_date);
        }
        if ($request->has('end_date') && !empty($request->end_date)) {
            $query->where('published_at', '<=', $request->end_date);
        }

        // Filtrelenmiş haberleri al
        $news = $query->with('coins')->get();
        return response()->json(['news' => $news]);
    }
}
