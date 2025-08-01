<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    /**
     * Display a listing of the partners.
     */
    public function index(Request $request)
    {
        $query = Partner::with('creator');
        
        // Filter by status if provided
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        // Search by name
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }
        
        // Default sorting
        $query->orderBy('display_order')->orderBy('created_at', 'desc');
        
        $partners = $query->paginate(10)->withQueryString();
        $statuses = ['all' => 'All Statuses', 'active' => 'Active', 'inactive' => 'Inactive'];
        
        return view('admin.partners.index', compact('partners', 'statuses'));
    }
    
    /**
     * Show the form for creating a new partner.
     */
    public function create()
    {
        return view('admin.partners.create');
    }
    
    /**
     * Store a newly created partner in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'url' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
            'display_order' => 'nullable|integer|min:0',
            'featured' => 'boolean',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Handle logo upload
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('partners', 'public');
        }
        
        // Create partner
        $partner = Partner::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'description' => $request->description,
            'logo' => $logoPath,
            'url' => $request->url,
            'status' => $request->status,
            'featured' => $request->has('featured'),
            'display_order' => $request->display_order ?? 0,
            'created_by' => Auth::id(),
        ]);
        
        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner created successfully.');
    }
    
    /**
     * Display the specified partner.
     */
    public function show(Partner $partner)
    {
        $partner->load('creator');
        
        return view('admin.partners.show', compact('partner'));
    }
    
    /**
     * Show the form for editing the specified partner.
     */
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }
    
    /**
     * Update the specified partner in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'url' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
            'display_order' => 'nullable|integer|min:0',
            'featured' => 'boolean',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }
            
            $logoPath = $request->file('logo')->store('partners', 'public');
            $partner->logo = $logoPath;
        }
        
        // Update partner
        $partner->name = $request->name;
        $partner->description = $request->description;
        $partner->url = $request->url;
        $partner->status = $request->status;
        $partner->featured = $request->has('featured');
        $partner->display_order = $request->display_order ?? 0;
        
        $partner->save();
        
        return redirect()->route('admin.partners.show', $partner)
            ->with('success', 'Partner updated successfully.');
    }
    
    /**
     * Remove the specified partner from storage.
     */
    public function destroy(Partner $partner)
    {
        // Delete logo if exists
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }
        
        $partner->delete();
        
        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner deleted successfully.');
    }
}
