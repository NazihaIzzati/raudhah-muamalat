<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the news.
     */
    public function index(Request $request)
    {
        $query = News::with('creator');
        
        // Show trashed news if requested
        if ($request->has('trashed') && $request->trashed) {
            $query->onlyTrashed();
        } else {
            $query->whereNull('deleted_at'); // Only show non-deleted news by default
        }
        
        // Filter by status if provided
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        // Filter by category if provided
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }
        
        // Search by title and content
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
        }
        
        // Default sorting by display order and creation date
        $query->orderBy('display_order', 'asc')->orderBy('created_at', 'desc');
        
        $news = $query->paginate(10)->withQueryString();
        $statuses = ['all' => 'All Statuses', 'draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived'];
        $categories = array_merge(['all' => 'All Categories'], News::getCategories());
        
        // Get counts for tabs
        $activeCount = News::whereNull('deleted_at')->count();
        $trashedCount = News::onlyTrashed()->count();
        
        return view('admin.news.index', compact('news', 'statuses', 'categories', 'activeCount', 'trashedCount'));
    }
    
    /**
     * Show the form for creating a new news.
     */
    public function create()
    {
        $categories = News::getCategories();
        return view('admin.news.create', compact('categories'));
    }
    
    /**
     * Store a newly created news in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'category' => 'required|string|in:' . implode(',', array_keys(News::getCategories())),
            'status' => 'required|in:draft,published,archived',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'display_order' => 'nullable|integer|min:0',
            'featured' => 'boolean',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
        }
        
        // Generate slug
        $slug = Str::slug($request->title);
        $baseSlug = $slug;
        $counter = 1;
        
        // Ensure slug is unique
        while (News::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }
        
        // Create news
        $news = News::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'image_path' => $imagePath,
            'category' => $request->category,
            'status' => $request->status,
            'featured' => $request->has('featured'),
            'display_order' => $request->display_order ?? 0,
            'published_at' => $request->status === 'published' ? now() : null,
            'created_by' => Auth::user()->staff->id,
        ]);
        
        return redirect()->route('admin.news.index')
            ->with('success', 'News "' . $news->title . '" created successfully!');
    }
    
    /**
     * Display the specified news.
     */
    public function show(News $news)
    {
        $news->load('creator');
        
        return view('admin.news.show', compact('news'));
    }
    
    /**
     * Show the form for editing the specified news.
     */
    public function edit(News $news)
    {
        $categories = News::getCategories();
        return view('admin.news.edit', compact('news', 'categories'));
    }
    
    /**
     * Update the specified news in storage.
     */
    public function update(Request $request, News $news)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'category' => 'required|string|in:' . implode(',', array_keys(News::getCategories())),
            'status' => 'required|in:draft,published,archived',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'display_order' => 'nullable|integer|min:0',
            'featured' => 'boolean',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }
            $imagePath = $request->file('image')->store('news', 'public');
            $news->image_path = $imagePath;
        }
        
        // Update slug if title changed
        if ($news->title !== $request->title) {
            $slug = Str::slug($request->title);
            $baseSlug = $slug;
            $counter = 1;
            
            // Ensure slug is unique
            while (News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
            
            $news->slug = $slug;
        }
        
        // Update news
        $news->title = $request->title;
        $news->content = $request->content;
        $news->excerpt = $request->excerpt;
        $news->category = $request->category;
        $news->status = $request->status;
        $news->featured = $request->has('featured');
        $news->display_order = $request->display_order ?? 0;
        
        // Update published_at if status changed to published
        if ($request->status === 'published' && $news->status !== 'published') {
            $news->published_at = now();
        } elseif ($request->status !== 'published') {
            $news->published_at = null;
        }
        
        $news->save();
        
        return redirect()->route('admin.news.show', $news)
            ->with('success', 'News "' . $news->title . '" updated successfully!');
    }
    
    /**
     * Remove the specified news from storage (soft delete).
     */
    public function destroy(News $news)
    {
        $newsTitle = $news->title;
        $news->delete(); // This will now soft delete
        
        return redirect()->route('admin.news.index')
            ->with('success', 'News "' . $newsTitle . '" moved to trash successfully!');
    }
    
    /**
     * Restore the specified soft deleted news.
     */
    public function restore($id)
    {
        $news = News::onlyTrashed()->findOrFail($id);
        $newsTitle = $news->title;
        $news->restore();
        
        return redirect()->back()
            ->with('success', 'News "' . $newsTitle . '" restored successfully!');
    }
    
    /**
     * Permanently delete the specified news.
     */
    public function forceDelete($id)
    {
        $news = News::onlyTrashed()->findOrFail($id);
        $newsTitle = $news->title;
        
        // Delete image if exists
        if ($news->image_path) {
            Storage::disk('public')->delete($news->image_path);
        }
        
        $news->forceDelete();
        
        return redirect()->back()
            ->with('success', 'News "' . $newsTitle . '" permanently deleted!');
    }
    
    /**
     * Show trashed news.
     */
    public function trashed(Request $request)
    {
        $query = News::onlyTrashed()->with('creator');
        
        // Search by title and content
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
        }
        
        // Default sorting
        $query->orderBy('deleted_at', 'desc');
        
        $news = $query->paginate(10)->withQueryString();
        
        return view('admin.news.trashed', compact('news'));
    }
}
