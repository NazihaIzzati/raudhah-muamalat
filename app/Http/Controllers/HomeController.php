<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with dynamic news data.
     */
    public function index()
    {
        // Get featured news for home page
        $newsController = new NewsController();
        $newsData = $newsController->getFeaturedNews();

        return view('welcome', [
            'featuredNews' => $newsData['featured'],
            'recentNews' => $newsData['recent']
        ]);
    }
}
