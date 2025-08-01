<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display the public FAQ page.
     */
    public function index()
    {
        // Get active FAQs (excluding soft deleted) ordered by display_order and featured status
        $faqs = Faq::where('status', 'active')
            ->whereNull('deleted_at') // Explicitly exclude soft deleted FAQs
            ->orderBy('featured', 'desc')
            ->orderBy('display_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Group FAQs by category
        $faqsByCategory = $faqs->groupBy('category');
        $categories = Faq::getCategories();

        return view('faq', compact('faqs', 'faqsByCategory', 'categories'));
    }
}
