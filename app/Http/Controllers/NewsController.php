<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display the public news page.
     */
    public function index()
    {
        // Get published news (excluding soft deleted) ordered by display_order and featured status
        $news = News::where('status', 'published')
            ->whereNull('deleted_at') // Explicitly exclude soft deleted news
            ->orderBy('featured', 'desc')
            ->orderBy('display_order', 'asc')
            ->orderBy('published_at', 'desc')
            ->get();

        // Group news by category
        $newsByCategory = $news->groupBy('category');
        $categories = News::getCategories();

        return view('news', compact('news', 'newsByCategory', 'categories'));
    }
}
