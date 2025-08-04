<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Campaign;
use App\Models\Donor;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
{
    /**
     * Display a listing of the donations.
     */
    public function index(Request $request)
    {
        $query = Donation::with(['donor', 'campaign']);
        
        // Filter by status if provided
        if ($request->has('status') && $request->status != 'all') {
            $query->where('payment_status', $request->status);
        }
        
        // Filter by campaign if provided
        if ($request->has('campaign_id') && $request->campaign_id) {
            $query->where('campaign_id', $request->campaign_id);
        }
        
        // Search by donor name or email
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('donor_name', 'like', "%{$search}%")
                  ->orWhere('donor_email', 'like', "%{$search}%")
                  ->orWhere('transaction_id', 'like', "%{$search}%");
            });
        }
        
        // Default sorting
        $query->orderBy('created_at', 'desc');
        
        $donations = $query->paginate(10)->withQueryString();
        $campaigns = Campaign::pluck('title', 'id');
        $donors = Donor::with('user')->get()->pluck('user.name', 'id');
        $statuses = ['all' => 'All Statuses', 'completed' => 'Completed', 'pending' => 'Pending', 'failed' => 'Failed', 'refunded' => 'Refunded'];
        
        return view('admin.donations.index', compact('donations', 'campaigns', 'donors', 'statuses'));
    }
    
    /**
     * Show the form for creating a new donation.
     */
    public function create()
    {
        $campaigns = Campaign::where('status', 'active')->pluck('title', 'id');
        $donors = Donor::with('user')->get()->pluck('user.name', 'id');
        $paymentMethods = ['credit_card' => 'Credit Card', 'bank_transfer' => 'Bank Transfer', 'paypal' => 'PayPal', 'cash' => 'Cash', 'other' => 'Other'];
        $statuses = ['completed' => 'Completed', 'pending' => 'Pending', 'failed' => 'Failed', 'refunded' => 'Refunded'];
        $currencies = ['USD' => 'USD', 'EUR' => 'EUR', 'GBP' => 'GBP', 'MYR' => 'MYR', 'IDR' => 'IDR'];
        
        return view('admin.donations.create', compact('campaigns', 'donors', 'paymentMethods', 'statuses', 'currencies'));
    }
    
    /**
     * Store a newly created donation in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'donor_id' => 'nullable|exists:donors,id',
            'campaign_id' => 'required|exists:campaigns,id',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'donor_phone' => 'nullable|string|max:20',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|max:3',
            'payment_method' => 'required|string|max:255',
            'payment_status' => 'required|in:completed,pending,failed,refunded',
            'transaction_id' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'is_anonymous' => 'boolean',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Create donation
        $donation = new Donation($request->all());
        $donation->is_anonymous = $request->has('is_anonymous');
        
        // Set paid_at date if status is completed
        if ($request->payment_status === 'completed') {
            $donation->paid_at = now();
        }
        
        $donation->save();
        
        // Update campaign raised amount if donation is completed
        if ($request->payment_status === 'completed' && $donation->campaign) {
            $campaign = $donation->campaign;
            $campaign->raised_amount = $campaign->raised_amount + $donation->amount;
            $campaign->save();
        }
        
        // Create notification for new donation
        try {
            Notification::createDonationNotification($donation);
        } catch (\Exception $e) {
            // Log error but don't fail the donation creation
            \Log::error('Failed to create donation notification: ' . $e->getMessage());
        }
        
        return redirect()->route('admin.donations.index')
            ->with('success', 'Donation created successfully.');
    }
    
    /**
     * Show the details for a specific donation.
     */
    public function show(Donation $donation)
    {
        $donation->load(['user', 'campaign']);
        return view('admin.donations.show', compact('donation'));
    }
    
    /**
     * Show the form for editing the specified donation.
     */
    public function edit(Donation $donation)
    {
        $campaigns = Campaign::pluck('title', 'id');
        $users = User::pluck('name', 'id');
        $paymentMethods = ['credit_card' => 'Credit Card', 'bank_transfer' => 'Bank Transfer', 'paypal' => 'PayPal', 'cash' => 'Cash', 'other' => 'Other'];
        $statuses = ['completed' => 'Completed', 'pending' => 'Pending', 'failed' => 'Failed', 'refunded' => 'Refunded'];
        $currencies = ['USD' => 'USD', 'EUR' => 'EUR', 'GBP' => 'GBP', 'MYR' => 'MYR', 'IDR' => 'IDR'];
        
        return view('admin.donations.edit', compact('donation', 'campaigns', 'users', 'paymentMethods', 'statuses', 'currencies'));
    }
    
    /**
     * Update the specified donation in storage.
     */
    public function update(Request $request, Donation $donation)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|exists:users,id',
            'campaign_id' => 'required|exists:campaigns,id',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'donor_phone' => 'nullable|string|max:20',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|max:3',
            'payment_method' => 'required|string|max:255',
            'payment_status' => 'required|in:completed,pending,failed,refunded',
            'transaction_id' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'is_anonymous' => 'boolean',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Store old values for comparison
        $oldStatus = $donation->payment_status;
        $oldAmount = $donation->amount;
        $oldCampaignId = $donation->campaign_id;
        
        // Update donation
        $donation->fill($request->except('is_anonymous'));
        $donation->is_anonymous = $request->has('is_anonymous');
        
        // Set paid_at date if status is completed and wasn't before
        if ($request->payment_status === 'completed' && $oldStatus !== 'completed') {
            $donation->paid_at = now();
        }
        
        // Handle campaign raised amount updates
        
        // If campaign changed, update both old and new campaign
        if ($oldCampaignId != $request->campaign_id) {
            // Reduce amount from old campaign if donation was completed
            if ($oldStatus === 'completed' && $oldCampaignId) {
                $oldCampaign = Campaign::find($oldCampaignId);
                if ($oldCampaign) {
                    $oldCampaign->raised_amount = max(0, $oldCampaign->raised_amount - $oldAmount);
                    $oldCampaign->save();
                }
            }
            
            // Add amount to new campaign if donation is completed
            if ($request->payment_status === 'completed') {
                $newCampaign = Campaign::find($request->campaign_id);
                if ($newCampaign) {
                    $newCampaign->raised_amount = $newCampaign->raised_amount + $request->amount;
                    $newCampaign->save();
                }
            }
        } 
        // If campaign didn't change but status or amount did
        else {
            $campaign = Campaign::find($request->campaign_id);
            if ($campaign) {
                // If donation was completed and is still completed but amount changed
                if ($oldStatus === 'completed' && $request->payment_status === 'completed' && $oldAmount != $request->amount) {
                    $campaign->raised_amount = $campaign->raised_amount - $oldAmount + $request->amount;
                }
                // If donation was not completed but now is
                elseif ($oldStatus !== 'completed' && $request->payment_status === 'completed') {
                    $campaign->raised_amount = $campaign->raised_amount + $request->amount;
                    
                    // Create notification for newly completed donation
                    try {
                        Notification::createDonationNotification($donation);
                    } catch (\Exception $e) {
                        // Log error but don't fail the update
                        \Log::error('Failed to create donation notification: ' . $e->getMessage());
                    }
                }
                // If donation was completed but now is not
                elseif ($oldStatus === 'completed' && $request->payment_status !== 'completed') {
                    $campaign->raised_amount = max(0, $campaign->raised_amount - $oldAmount);
                }
                
                $campaign->save();
            }
        }
        
        $donation->save();
        
        return redirect()->route('admin.donations.show', $donation)
            ->with('success', 'Donation updated successfully.');
    }
    
    /**
     * Update the donation status.
     */
    public function updateStatus(Request $request, Donation $donation)
    {
        $request->validate([
            'payment_status' => 'required|in:completed,pending,failed,refunded',
        ]);
        
        $oldStatus = $donation->payment_status;
        $donation->payment_status = $request->payment_status;
        
        // If donation was marked as completed and wasn't before, update campaign raised amount
        if ($request->payment_status === 'completed' && $oldStatus !== 'completed' && $donation->campaign) {
            $campaign = $donation->campaign;
            $campaign->raised_amount = $campaign->raised_amount + $donation->amount;
            $campaign->save();
            
            // Create notification for newly completed donation
            try {
                Notification::createDonationNotification($donation);
            } catch (\Exception $e) {
                // Log error but don't fail the status update
                \Log::error('Failed to create donation notification: ' . $e->getMessage());
            }
        }
        
        // If donation was previously completed but now isn't, reduce campaign raised amount
        if ($oldStatus === 'completed' && $request->payment_status !== 'completed' && $donation->campaign) {
            $campaign = $donation->campaign;
            $campaign->raised_amount = max(0, $campaign->raised_amount - $donation->amount);
            $campaign->save();
        }
        
        $donation->save();
        
        return redirect()->route('admin.donations.show', $donation)
            ->with('success', 'Donation status updated successfully.');
    }
    
    /**
     * Delete a donation.
     */
    public function destroy(Donation $donation)
    {
        // If donation was completed, update campaign raised amount
        if ($donation->payment_status === 'completed' && $donation->campaign) {
            $campaign = $donation->campaign;
            $campaign->raised_amount = max(0, $campaign->raised_amount - $donation->amount);
            $campaign->save();
        }
        
        $donation->delete();
        
        return redirect()->route('admin.donations.index')
            ->with('success', 'Donation deleted successfully.');
    }
    
    /**
     * Export donations as CSV.
     */
    public function export(Request $request)
    {
        $query = Donation::with(['user', 'campaign']);
        
        // Apply filters similar to index method
        if ($request->has('status') && $request->status != 'all') {
            $query->where('payment_status', $request->status);
        }
        
        if ($request->has('campaign_id') && $request->campaign_id) {
            $query->where('campaign_id', $request->campaign_id);
        }
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('donor_name', 'like', "%{$search}%")
                  ->orWhere('donor_email', 'like', "%{$search}%")
                  ->orWhere('transaction_id', 'like', "%{$search}%");
            });
        }
        
        $donations = $query->orderBy('created_at', 'desc')->get();
        
        $filename = 'donations-' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];
        
        $callback = function() use ($donations) {
            $file = fopen('php://output', 'w');
            
            // Add CSV header
            fputcsv($file, [
                'ID', 'Donor Name', 'Email', 'Phone', 'Amount', 'Currency',
                'Campaign', 'Status', 'Payment Method', 'Transaction ID',
                'Anonymous', 'Date', 'Message'
            ]);
            
            // Add data rows
            foreach ($donations as $donation) {
                fputcsv($file, [
                    $donation->id,
                    $donation->donor_name,
                    $donation->donor_email,
                    $donation->donor_phone ?? 'N/A',
                    $donation->amount,
                    $donation->currency,
                    $donation->campaign ? $donation->campaign->title : 'N/A',
                    $donation->payment_status,
                    $donation->payment_method,
                    $donation->transaction_id ?? 'N/A',
                    $donation->is_anonymous ? 'Yes' : 'No',
                    $donation->created_at->format('Y-m-d H:i:s'),
                    $donation->message ?? 'N/A'
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
