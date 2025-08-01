<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poster;
use App\Models\Campaign;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PosterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Poster::with(['campaign', 'creator']);
        
        // Handle search
        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }
        
        // Handle status filter
        if ($request->filled('status') && $request->get('status') !== '') {
            $query->where('status', $request->get('status'));
        }
        
        // Handle category filter
        if ($request->filled('category') && $request->get('category') !== '') {
            $query->where('category', $request->get('category'));
        }
        
        $posters = $query->orderBy('display_order')->paginate(10);
        
        // Define status options for the filter dropdown
        $statuses = [
            '' => 'All Statuses',
            'published' => 'Published',
            'draft' => 'Draft',
            'archived' => 'Archived',
        ];
        
        return view('admin.posters.index', compact('posters', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $campaigns = Campaign::where('status', 'active')->get();
        return view('admin.posters.create', compact('campaigns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => ['required', Rule::in(['published', 'draft', 'archived'])],
            'category' => 'nullable|string|in:promotional,informational,event,campaign',
            'display_from' => 'nullable|date',
            'display_until' => 'nullable|date|after_or_equal:display_from',
            'display_order' => 'nullable|integer|min:0',
            'campaign_id' => 'nullable|exists:campaigns,id',
            'poster_image' => 'required|image|max:2048', // 2MB max
            'featured' => 'boolean',
        ]);
        
        // Generate slug
        $slug = Str::slug($validated['title']);
        $baseSlug = $slug;
        $counter = 1;
        
        // Ensure slug is unique
        while (Poster::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }
        
        // Handle file upload
        if ($request->hasFile('poster_image')) {
            $imagePath = $request->file('poster_image')->store('posters', 'public');
            $fileSize = round($request->file('poster_image')->getSize() / 1024); // Size in KB
        }
        
        // Create poster
        $poster = Poster::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'image_path' => $imagePath ?? null,
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
            'category' => $validated['category'] ?? null,
            'display_from' => $validated['display_from'] ?? null,
            'display_until' => $validated['display_until'] ?? null,
            'display_order' => $validated['display_order'] ?? 0,
            'campaign_id' => $validated['campaign_id'] ?? null,
            'featured' => $validated['featured'] ?? false,
            'file_size' => $fileSize ?? null,
            'created_by' => auth()->id(),
        ]);
        
        return redirect()->route('admin.posters.show', $poster)
            ->with('success', 'Poster created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Poster $poster)
    {
        return view('admin.posters.show', compact('poster'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poster $poster)
    {
        $campaigns = Campaign::where('status', 'active')->get();
        return view('admin.posters.edit', compact('poster', 'campaigns'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poster $poster)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => ['required', Rule::in(['published', 'draft', 'archived'])],
            'category' => 'nullable|string|in:promotional,informational,event,campaign',
            'display_from' => 'nullable|date',
            'display_until' => 'nullable|date|after_or_equal:display_from',
            'display_order' => 'nullable|integer|min:0',
            'campaign_id' => 'nullable|exists:campaigns,id',
            'poster_image' => 'nullable|image|max:2048', // 2MB max
            'featured' => 'boolean',
        ]);
        
        // Update slug if title changed
        if ($poster->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $baseSlug = $slug;
            $counter = 1;
            
            // Ensure slug is unique
            while (Poster::where('slug', $slug)->where('id', '!=', $poster->id)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
            
            $poster->slug = $slug;
        }
        
        // Handle file upload
        if ($request->hasFile('poster_image')) {
            // Delete old image
            if ($poster->image_path) {
                Storage::disk('public')->delete($poster->image_path);
            }
            
            $imagePath = $request->file('poster_image')->store('posters', 'public');
            $fileSize = round($request->file('poster_image')->getSize() / 1024); // Size in KB
            $poster->image_path = $imagePath;
            $poster->file_size = $fileSize;
        }
        
        // Update poster
        $poster->title = $validated['title'];
        $poster->description = $validated['description'] ?? null;
        $poster->status = $validated['status'];
        $poster->category = $validated['category'] ?? null;
        $poster->display_from = $validated['display_from'] ?? null;
        $poster->display_until = $validated['display_until'] ?? null;
        $poster->display_order = $validated['display_order'] ?? 0;
        $poster->campaign_id = $validated['campaign_id'] ?? null;
        $poster->featured = $validated['featured'] ?? false;
        $poster->save();
        
        return redirect()->route('admin.posters.show', $poster)
            ->with('success', 'Poster updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poster $poster)
    {
        // Delete image file
        if ($poster->image_path) {
            Storage::disk('public')->delete($poster->image_path);
        }
        
        $poster->delete();
        
        return redirect()->route('admin.posters.index')
            ->with('success', 'Poster deleted successfully.');
    }
}
