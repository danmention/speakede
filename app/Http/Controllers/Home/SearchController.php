<?php

namespace App\Http\Controllers\Home;

use App\Services\home\SearchService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController
{

    /**
     * @var SearchService
     */
    private $searchService;

    /**
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;

    }


    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function getSearchResult(Request $request){
        $data = $this->searchService->search($request);
        return view('home.search', $data);
    }
}
