<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     */
    public function index(Request $request)
    {
        $query = Event::with('creator');
        
        // Filter by status if provided
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        // Filter by category if provided
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }
        
        // Search by title
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
        }
        
        // Default sorting
        $query->orderBy('start_date', 'desc');
        
        $events = $query->paginate(10)->withQueryString();
        $statuses = ['all' => 'All Statuses', 'draft' => 'Draft', 'published' => 'Published', 'ongoing' => 'Ongoing', 'completed' => 'Completed', 'cancelled' => 'Cancelled'];
        $categories = ['all' => 'All Categories', 'conference' => 'Conference', 'workshop' => 'Workshop', 'seminar' => 'Seminar', 'charity' => 'Charity', 'fundraising' => 'Fundraising', 'community' => 'Community', 'other' => 'Other'];
        
        return view('admin.events.index', compact('events', 'statuses', 'categories'));
    }
    
    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        $categories = ['conference' => 'Conference', 'workshop' => 'Workshop', 'seminar' => 'Seminar', 'charity' => 'Charity', 'fundraising' => 'Fundraising', 'community' => 'Community', 'other' => 'Other'];
        $currencies = ['USD' => 'USD', 'EUR' => 'EUR', 'GBP' => 'GBP', 'MYR' => 'MYR', 'IDR' => 'IDR'];
        return view('admin.events.create', compact('categories', 'currencies'));
    }
    
    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'max_participants' => 'nullable|integer|min:1',
            'registration_fee' => 'nullable|numeric|min:0',
            'currency' => 'required|string|max:3',
            'category' => 'nullable|string|max:50',
            'status' => 'required|in:draft,published,ongoing,completed,cancelled',
            'is_featured' => 'boolean',
            'registration_required' => 'boolean',
            'registration_deadline' => 'nullable|date|before_or_equal:start_date',
            'contact_info.phone' => 'nullable|string|max:20',
            'contact_info.email' => 'nullable|email|max:255',
            'contact_info.website' => 'nullable|url|max:255',
            'social_links.facebook' => 'nullable|url|max:255',
            'social_links.twitter' => 'nullable|url|max:255',
            'social_links.instagram' => 'nullable|url|max:255',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('events', 'public');
        }
        
        // Prepare contact info and social links
        $contactInfo = array_filter([
            'phone' => $request->input('contact_info.phone'),
            'email' => $request->input('contact_info.email'),
            'website' => $request->input('contact_info.website'),
        ]);
        
        $socialLinks = array_filter([
            'facebook' => $request->input('social_links.facebook'),
            'twitter' => $request->input('social_links.twitter'),
            'instagram' => $request->input('social_links.instagram'),
        ]);
        
        // Create event
        $event = Event::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'description' => $request->description,
            'content' => $request->content,
            'featured_image' => $imagePath,
            'location' => $request->location,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'max_participants' => $request->max_participants,
            'registered_participants' => 0,
            'registration_fee' => $request->registration_fee ?? 0,
            'currency' => $request->currency,
            'category' => $request->category,
            'status' => $request->status,
            'is_featured' => $request->boolean('is_featured'),
            'registration_required' => $request->boolean('registration_required'),
            'registration_deadline' => $request->registration_deadline,
            'contact_info' => !empty($contactInfo) ? $contactInfo : null,
            'social_links' => !empty($socialLinks) ? $socialLinks : null,
            'created_by' => Auth::id(),
        ]);
        
        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully.');
    }
    
    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        $event->load('creator');
        
        return view('admin.events.show', compact('event'));
    }
    
    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        $categories = ['conference' => 'Conference', 'workshop' => 'Workshop', 'seminar' => 'Seminar', 'charity' => 'Charity', 'fundraising' => 'Fundraising', 'community' => 'Community', 'other' => 'Other'];
        $currencies = ['USD' => 'USD', 'EUR' => 'EUR', 'GBP' => 'GBP', 'MYR' => 'MYR', 'IDR' => 'IDR'];
        return view('admin.events.edit', compact('event', 'categories', 'currencies'));
    }
    
    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'max_participants' => 'nullable|integer|min:1',
            'registration_fee' => 'nullable|numeric|min:0',
            'currency' => 'required|string|max:3',
            'category' => 'nullable|string|max:50',
            'status' => 'required|in:draft,published,ongoing,completed,cancelled',
            'is_featured' => 'boolean',
            'registration_required' => 'boolean',
            'registration_deadline' => 'nullable|date|before_or_equal:start_date',
            'contact_info.phone' => 'nullable|string|max:20',
            'contact_info.email' => 'nullable|email|max:255',
            'contact_info.website' => 'nullable|url|max:255',
            'social_links.facebook' => 'nullable|url|max:255',
            'social_links.twitter' => 'nullable|url|max:255',
            'social_links.instagram' => 'nullable|url|max:255',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($event->featured_image) {
                Storage::disk('public')->delete($event->featured_image);
            }
            
            $imagePath = $request->file('featured_image')->store('events', 'public');
            $event->featured_image = $imagePath;
        }
        
        // Prepare contact info and social links
        $contactInfo = array_filter([
            'phone' => $request->input('contact_info.phone'),
            'email' => $request->input('contact_info.email'),
            'website' => $request->input('contact_info.website'),
        ]);
        
        $socialLinks = array_filter([
            'facebook' => $request->input('social_links.facebook'),
            'twitter' => $request->input('social_links.twitter'),
            'instagram' => $request->input('social_links.instagram'),
        ]);
        
        // Update event
        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'location' => $request->location,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'max_participants' => $request->max_participants,
            'registration_fee' => $request->registration_fee ?? 0,
            'currency' => $request->currency,
            'category' => $request->category,
            'status' => $request->status,
            'is_featured' => $request->boolean('is_featured'),
            'registration_required' => $request->boolean('registration_required'),
            'registration_deadline' => $request->registration_deadline,
            'contact_info' => !empty($contactInfo) ? $contactInfo : null,
            'social_links' => !empty($socialLinks) ? $socialLinks : null,
        ]);
        
        return redirect()->route('admin.events.show', $event)
            ->with('success', 'Event updated successfully.');
    }
    
    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        // Delete featured image if exists
        if ($event->featured_image) {
            Storage::disk('public')->delete($event->featured_image);
        }
        
        $event->delete();
        
        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }
}
