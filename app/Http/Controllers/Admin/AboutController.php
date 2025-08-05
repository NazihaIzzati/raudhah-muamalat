<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    /**
     * Display a listing of the about content.
     */
    public function index(Request $request)
    {
        $query = About::with(['creator', 'updater']);
        
        // Show trashed content if requested
        if ($request->has('trashed') && $request->trashed) {
            $query->onlyTrashed();
        } else {
            $query->whereNull('deleted_at'); // Only show non-deleted content by default
        }
        
        // Filter by status if provided
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        // Search by title
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('mission', 'like', "%{$search}%")
                  ->orWhere('vision', 'like', "%{$search}%");
        }
        
        // Default sorting
        $query->orderBy('display_order')->orderBy('created_at', 'desc');
        
        $abouts = $query->paginate(10)->withQueryString();
        $statuses = ['all' => 'All Statuses', 'active' => 'Active', 'inactive' => 'Inactive'];
        
        // Get counts for tabs
        $activeCount = About::whereNull('deleted_at')->count();
        $trashedCount = About::onlyTrashed()->count();
        
        return view('admin.abouts.index', compact('abouts', 'statuses', 'activeCount', 'trashedCount'));
    }
    
    /**
     * Show the form for creating a new about content.
     */
    public function create()
    {
        return view('admin.abouts.create');
    }
    
    /**
     * Store a newly created about content in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'mission' => 'nullable|string|max:2000',
            'vision' => 'nullable|string|max:2000',
            'values' => 'nullable|string|max:2000',
            'bank_muamalat_title' => 'nullable|string|max:255',
            'bank_muamalat_description' => 'nullable|string|max:3000',
            'payment_section_title' => 'nullable|string|max:255',
            'payment_section_description' => 'nullable|string|max:1000',
            'fpx_description' => 'nullable|string|max:1000',
            'duitnow_description' => 'nullable|string|max:1000',
            'hero_badge_text' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string|max:1000',
            'hero_highlights' => 'nullable|array',
            'hero_pills' => 'nullable|array',
            'hero_cta_buttons' => 'nullable|array',
            'status' => 'required|in:active,inactive',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Process JSON fields
        $heroHighlights = $this->processHeroHighlights($request->hero_highlights);
        $heroPills = $this->processHeroPills($request->hero_pills);
        $heroCtaButtons = $this->processHeroCtaButtons($request->hero_cta_buttons);
        
        // Create about content
        $about = About::create([
            'title' => $request->title,
            'mission' => $request->mission,
            'vision' => $request->vision,
            'values' => $request->values,
            'bank_muamalat_title' => $request->bank_muamalat_title,
            'bank_muamalat_description' => $request->bank_muamalat_description,
            'payment_section_title' => $request->payment_section_title,
            'payment_section_description' => $request->payment_section_description,
            'fpx_description' => $request->fpx_description,
            'duitnow_description' => $request->duitnow_description,
            'hero_badge_text' => $request->hero_badge_text,
            'hero_title' => $request->hero_title,
            'hero_subtitle' => $request->hero_subtitle,
            'hero_description' => $request->hero_description,
            'hero_highlights' => $heroHighlights,
            'hero_pills' => $heroPills,
            'hero_cta_buttons' => $heroCtaButtons,
            'status' => $request->status,
            'is_active' => $request->has('is_active'),
            'display_order' => $request->display_order ?? 0,
            'created_by' => Auth::user()->staff->id,
        ]);
        
        return redirect()->route('admin.abouts.index')
            ->with('success', 'About content "' . $about->title . '" created successfully!');
    }
    
    /**
     * Display the specified about content.
     */
    public function show(About $about)
    {
        $about->load(['creator', 'updater']);
        
        return view('admin.abouts.show', compact('about'));
    }
    
    /**
     * Show the form for editing the specified about content.
     */
    public function edit(About $about)
    {
        return view('admin.abouts.edit', compact('about'));
    }
    
    /**
     * Update the specified about content in storage.
     */
    public function update(Request $request, About $about)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'mission' => 'nullable|string|max:2000',
            'vision' => 'nullable|string|max:2000',
            'values' => 'nullable|string|max:2000',
            'bank_muamalat_title' => 'nullable|string|max:255',
            'bank_muamalat_description' => 'nullable|string|max:3000',
            'payment_section_title' => 'nullable|string|max:255',
            'payment_section_description' => 'nullable|string|max:1000',
            'fpx_description' => 'nullable|string|max:1000',
            'duitnow_description' => 'nullable|string|max:1000',
            'hero_badge_text' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string|max:1000',
            'hero_highlights' => 'nullable|array',
            'hero_pills' => 'nullable|array',
            'hero_cta_buttons' => 'nullable|array',
            'status' => 'required|in:active,inactive',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Process JSON fields
        $heroHighlights = $this->processHeroHighlights($request->hero_highlights);
        $heroPills = $this->processHeroPills($request->hero_pills);
        $heroCtaButtons = $this->processHeroCtaButtons($request->hero_cta_buttons);
        
        // Update about content
        $about->title = $request->title;
        $about->mission = $request->mission;
        $about->vision = $request->vision;
        $about->values = $request->values;
        $about->bank_muamalat_title = $request->bank_muamalat_title;
        $about->bank_muamalat_description = $request->bank_muamalat_description;
        $about->payment_section_title = $request->payment_section_title;
        $about->payment_section_description = $request->payment_section_description;
        $about->fpx_description = $request->fpx_description;
        $about->duitnow_description = $request->duitnow_description;
        $about->hero_badge_text = $request->hero_badge_text;
        $about->hero_title = $request->hero_title;
        $about->hero_subtitle = $request->hero_subtitle;
        $about->hero_description = $request->hero_description;
        $about->hero_highlights = $heroHighlights;
        $about->hero_pills = $heroPills;
        $about->hero_cta_buttons = $heroCtaButtons;
        $about->status = $request->status;
        $about->is_active = $request->has('is_active');
        $about->display_order = $request->display_order ?? 0;
        $about->updated_by = Auth::user()->staff->id;
        
        $about->save();
        
        return redirect()->route('admin.abouts.show', $about)
            ->with('success', 'About content "' . $about->title . '" updated successfully!');
    }
    
    /**
     * Remove the specified about content from storage (soft delete).
     */
    public function destroy(About $about)
    {
        $aboutTitle = $about->title;
        $about->delete(); // This will now soft delete
        
        return redirect()->route('admin.abouts.index')
            ->with('success', 'About content "' . $aboutTitle . '" moved to trash successfully!');
    }
    
    /**
     * Restore the specified soft deleted about content.
     */
    public function restore($id)
    {
        $about = About::onlyTrashed()->findOrFail($id);
        $aboutTitle = $about->title;
        $about->restore();
        
        return redirect()->back()
            ->with('success', 'About content "' . $aboutTitle . '" restored successfully!');
    }
    
    /**
     * Permanently delete the specified about content.
     */
    public function forceDelete($id)
    {
        $about = About::onlyTrashed()->findOrFail($id);
        $aboutTitle = $about->title;
        
        $about->forceDelete();
        
        return redirect()->back()
            ->with('success', 'About content "' . $aboutTitle . '" permanently deleted!');
    }
    
    /**
     * Show trashed about content.
     */
    public function trashed(Request $request)
    {
        $query = About::onlyTrashed()->with(['creator', 'updater']);
        
        // Search by title
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('mission', 'like', "%{$search}%")
                  ->orWhere('vision', 'like', "%{$search}%");
        }
        
        // Default sorting
        $query->orderBy('deleted_at', 'desc');
        
        $abouts = $query->paginate(10)->withQueryString();
        
        return view('admin.abouts.trashed', compact('abouts'));
    }
    
    /**
     * Process hero highlights array.
     */
    private function processHeroHighlights($highlights)
    {
        if (!$highlights) return null;
        
        $processed = [];
        foreach ($highlights as $highlight) {
            if (!empty($highlight['text'])) {
                $processed[] = [
                    'text' => $highlight['text'],
                    'delay' => $highlight['delay'] ?? '0s'
                ];
            }
        }
        
        return $processed;
    }
    
    /**
     * Process hero pills array.
     */
    private function processHeroPills($pills)
    {
        if (!$pills) return null;
        
        $processed = [];
        foreach ($pills as $pill) {
            if (!empty($pill['text'])) {
                $processed[] = [
                    'text' => $pill['text'],
                    'delay' => $pill['delay'] ?? '0s'
                ];
            }
        }
        
        return $processed;
    }
    
    /**
     * Process hero CTA buttons array.
     */
    private function processHeroCtaButtons($buttons)
    {
        if (!$buttons) return null;
        
        $processed = [];
        foreach ($buttons as $button) {
            if (!empty($button['text']) && !empty($button['url'])) {
                $processed[] = [
                    'text' => $button['text'],
                    'url' => $button['url'],
                    'type' => $button['type'] ?? 'primary'
                ];
            }
        }
        
        return $processed;
    }
}
