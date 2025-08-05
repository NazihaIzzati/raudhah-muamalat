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

    /**
     * Get featured news for home page.
     */
    public function getFeaturedNews()
    {
        // Get the latest featured news or the most recent news if no featured
        $featuredNews = News::where('status', 'published')
            ->whereNull('deleted_at')
            ->where('featured', true)
            ->orderBy('display_order', 'asc')
            ->orderBy('published_at', 'desc')
            ->first();

        // If no featured news, get the latest news
        if (!$featuredNews) {
            $featuredNews = News::where('status', 'published')
                ->whereNull('deleted_at')
                ->orderBy('published_at', 'desc')
                ->first();
        }

        // Get recent news for the sidebar (excluding the featured one)
        $recentNews = News::where('status', 'published')
            ->whereNull('deleted_at')
            ->when($featuredNews, function($query) use ($featuredNews) {
                return $query->where('id', '!=', $featuredNews->id);
            })
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return [
            'featured' => $featuredNews,
            'recent' => $recentNews
        ];
    }
}
