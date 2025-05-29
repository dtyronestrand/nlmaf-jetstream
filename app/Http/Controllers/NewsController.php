<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class NewsController extends Controller
{
    public function index(): InertiaResponse
    {
   
        $newsPaginator = News::publishedInListings()
            ->with('blocks')
            ->orderBy('publish_start_date', 'desc')
            ->paginate(10);
        $newsPaginator->getCollection()->transform(function (News $newsItem){
            $newsItem->computeBlocks();
            return $newsItem;
        });
      
        return Inertia::render('News/Index', [
            'news' => $newsPaginator,
        ]);
    }
    public function show(Request $request, int $id): InertiaResponse
    {
        $newsItem = News::publishedInListings()
            ->with('blocks')
            ->findOrFail($id);
        $newsItem->computeBlocks();
        return Inertia::render('News/Show', [
            'news' => $newsItem->only($newsItem->publicAttributes),
        ]);
    }
}

