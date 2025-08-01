<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    /**
     * Display the public partners page.
     */
    public function index()
    {
        // Get active partners (excluding soft deleted) ordered by display_order and featured status
        $partners = Partner::where('status', 'active')
            ->whereNull('deleted_at') // Explicitly exclude soft deleted partners
            ->orderBy('featured', 'desc')
            ->orderBy('display_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Separate featured and regular partners
        $featuredPartners = $partners->where('featured', true);
        $regularPartners = $partners->where('featured', false);

        return view('partners', compact('partners', 'featuredPartners', 'regularPartners'));
    }
} 