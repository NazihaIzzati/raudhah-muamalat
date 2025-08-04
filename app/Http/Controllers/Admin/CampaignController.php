<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    /**
     * Display a listing of the campaigns.
     */
    public function index(Request $request)
    {
        $query = Campaign::with('creator');
        
        // Filter by status if provided
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        // Search by title
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }
        
        // Default sorting
        $query->orderBy('created_at', 'desc');
        
        $campaigns = $query->paginate(10)->withQueryString();
        $statuses = ['all' => 'All Statuses', 'draft' => 'Draft', 'active' => 'Active', 'completed' => 'Completed', 'cancelled' => 'Cancelled'];
        
        return view('admin.campaigns.index', compact('campaigns', 'statuses'));
    }
    
    /**
     * Show the form for creating a new campaign.
     */
    public function create()
    {
        $currencies = ['USD' => 'USD', 'EUR' => 'EUR', 'GBP' => 'GBP', 'MYR' => 'MYR', 'IDR' => 'IDR'];
        return view('admin.campaigns.create', compact('currencies'));
    }
    
    /**
     * Store a newly created campaign in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'qr_code_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'goal_amount' => 'required|numeric|min:1',
            'currency' => 'required|string|max:3',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:draft,active,completed,cancelled',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Handle featured image upload
        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('campaigns', 'public');
        }

        // Handle QR code image upload
        $qrCodePath = null;
        if ($request->hasFile('qr_code_image')) {
            $qrCodePath = $request->file('qr_code_image')->store('campaigns/qr-codes', 'public');
        }
        
        // Create campaign
        $campaign = Campaign::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'description' => $request->description,
            'content' => $request->content,
            'featured_image' => $imagePath,
            'qr_code_image' => $qrCodePath,
            'goal_amount' => $request->goal_amount,
            'raised_amount' => 0,
            'currency' => $request->currency,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'created_by' => Auth::user()->staff->id,
        ]);
        
        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign created successfully.');
    }
    
    /**
     * Display the specified campaign.
     */
    public function show(Campaign $campaign)
    {
        $campaign->load('creator');
        
        // Get recent donations for this campaign
        $recentDonations = Donation::where('campaign_id', $campaign->id)
            ->where('payment_status', 'completed')
            ->latest()
            ->take(5)
            ->get();
        
        // Get donation statistics
        $totalDonations = Donation::where('campaign_id', $campaign->id)
            ->where('payment_status', 'completed')
            ->count();
        
        $averageDonation = Donation::where('campaign_id', $campaign->id)
            ->where('payment_status', 'completed')
            ->avg('amount') ?? 0;
        
        return view('admin.campaigns.show', compact('campaign', 'recentDonations', 'totalDonations', 'averageDonation'));
    }
    
    /**
     * Show the form for editing the specified campaign.
     */
    public function edit(Campaign $campaign)
    {
        $currencies = ['USD' => 'USD', 'EUR' => 'EUR', 'GBP' => 'GBP', 'MYR' => 'MYR', 'IDR' => 'IDR'];
        return view('admin.campaigns.edit', compact('campaign', 'currencies'));
    }
    
    /**
     * Update the specified campaign in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'qr_code_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'goal_amount' => 'required|numeric|min:1',
            'currency' => 'required|string|max:3',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:draft,active,completed,cancelled',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($campaign->featured_image) {
                Storage::disk('public')->delete($campaign->featured_image);
            }
            
            $imagePath = $request->file('featured_image')->store('campaigns', 'public');
            $campaign->featured_image = $imagePath;
        }

        // Handle QR code image upload
        if ($request->hasFile('qr_code_image')) {
            // Delete old QR code if exists
            if ($campaign->qr_code_image) {
                Storage::disk('public')->delete($campaign->qr_code_image);
            }
            
            $qrCodePath = $request->file('qr_code_image')->store('campaigns/qr-codes', 'public');
            $campaign->qr_code_image = $qrCodePath;
        }
        
        // Update campaign
        $campaign->title = $request->title;
        $campaign->description = $request->description;
        $campaign->content = $request->content;
        $campaign->goal_amount = $request->goal_amount;
        $campaign->currency = $request->currency;
        $campaign->start_date = $request->start_date;
        $campaign->end_date = $request->end_date;
        $campaign->status = $request->status;
        
        $campaign->save();
        
        return redirect()->route('admin.campaigns.show', $campaign)
            ->with('success', 'Campaign updated successfully.');
    }
    
    /**
     * Remove the specified campaign from storage.
     */
    public function destroy(Campaign $campaign)
    {
        // Check if campaign has donations
        $hasDonations = Donation::where('campaign_id', $campaign->id)->exists();
        
        if ($hasDonations) {
            return redirect()->back()
                ->with('error', 'Cannot delete campaign with donations. Please archive it instead.');
        }
        
        // Delete featured image if exists
        if ($campaign->featured_image) {
            Storage::disk('public')->delete($campaign->featured_image);
        }

        // Delete QR code image if exists
        if ($campaign->qr_code_image) {
            Storage::disk('public')->delete($campaign->qr_code_image);
        }
        
        $campaign->delete();
        
        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign deleted successfully.');
    }
}
