<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Campaign;

class DonationController extends Controller
{
    /**
     * Display a listing of the donations.
     */
    public function index(Request $request)
    {
        $query = Donation::with(['user', 'campaign']);
        
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
        $statuses = ['all' => 'All Statuses', 'completed' => 'Completed', 'pending' => 'Pending', 'failed' => 'Failed', 'refunded' => 'Refunded'];
        
        return view('admin.donations.index', compact('donations', 'campaigns', 'statuses'));
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
