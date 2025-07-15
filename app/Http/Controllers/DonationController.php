<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
{
    /**
     * Display the donation form
     *
     * @param Request $request
     * @param int|null $campaignId
     * @return \Illuminate\View\View
     */
    public function showForm(Request $request, $campaignId = null)
    {
        $campaign = null;
        if ($campaignId) {
            $campaign = Campaign::where('status', 'active')->findOrFail($campaignId);
        }
        
        $campaigns = Campaign::where('status', 'active')->get();
        
        return view('donate', compact('campaign', 'campaigns'));
    }
    
    /**
     * Process the donation form submission
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processDonation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'campaign_id' => 'required|exists:campaigns,id',
            'amount' => 'required_without:custom_amount|numeric|min:1|nullable',
            'custom_amount' => 'required_without:amount|numeric|min:1|nullable',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'donor_phone' => 'nullable|string|max:20',
            'message' => 'nullable|string',
            'is_anonymous' => 'boolean',
            'payment_method' => 'required|string|in:fpx,duitnow_qr,card,cardzone',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Determine the final amount
        $amount = $request->custom_amount ?? $request->amount;
        
        // Create donation record
        $donation = new Donation();
        $donation->user_id = Auth::id();
        $donation->campaign_id = $request->campaign_id;
        $donation->donor_name = $request->donor_name;
        $donation->donor_email = $request->donor_email;
        $donation->donor_phone = $request->donor_phone;
        $donation->amount = $amount;
        $donation->currency = 'MYR'; // Default to Malaysian Ringgit
        $donation->payment_method = $request->payment_method;
        $donation->payment_status = 'pending';
        $donation->message = $request->message;
        $donation->is_anonymous = $request->has('is_anonymous');
        $donation->save();
        
        // Redirect to appropriate payment processor
        switch ($request->payment_method) {
            case 'cardzone':
                return redirect()->route('payment.cardzone.process', ['donationId' => $donation->id]);
            case 'fpx':
                // Placeholder for FPX integration
                return redirect()->route('payment.fpx.process', ['donationId' => $donation->id]);
            case 'duitnow_qr':
                // Placeholder for DuitNow QR integration
                return redirect()->route('payment.duitnow.process', ['donationId' => $donation->id]);
            case 'card':
                // Redirect to Cardzone for card payments as well
                return redirect()->route('payment.cardzone.process', ['donationId' => $donation->id]);
            default:
                return redirect()->back()
                    ->with('error', 'Invalid payment method selected.')
                    ->withInput();
        }
    }
}
