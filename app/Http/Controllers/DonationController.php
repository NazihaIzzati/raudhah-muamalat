<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\PaymentController;

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
     * Display the donation confirmation page
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function showConfirmation(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'campaign_id' => 'required|exists:campaigns,id',
            'amount' => 'required_without:custom_amount|numeric|min:1|nullable',
            'custom_amount' => 'required_without:amount|numeric|min:1|nullable',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'donor_phone' => 'nullable|string|max:20',
            'message' => 'nullable|string',
            'is_anonymous' => 'boolean',

            'payment_method' => 'nullable|string|in:fpx,duitnow_qr,card,cardzone,obw,qr',
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('donate.form')
                ->withErrors($validator)
                ->withInput();
        }
        
        // Get campaign details
        $campaign = Campaign::findOrFail($request->campaign_id);
        
        // Prepare confirmation data
        $confirmationData = [
            'campaign' => $campaign,
            'amount' => $request->custom_amount ?? $request->amount,

            'payment_method' => $request->payment_method ?? 'card',
            'donor_name' => $request->donor_name,
            'donor_email' => $request->donor_email,
            'donor_phone' => $request->donor_phone,
            'message' => $request->message,
            'is_anonymous' => $request->has('is_anonymous'),
        ];
        
        return view('donation-confirmation', compact('confirmationData'));
    }
    
    /**
     * Process the donation form submission and redirect to payment page
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
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
            'payment_method' => 'required|string|in:fpx,duitnow_qr,card,cardzone,obw,qr',
        ]);
        
        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $amount = $request->custom_amount ?? $request->amount;
        $donation = new Donation();
        $donation->user_id = Auth::id();
        $donation->campaign_id = $request->campaign_id;
        $donation->donor_name = $request->donor_name;
        $donation->donor_email = $request->donor_email;
        $donation->donor_phone = $request->donor_phone;
        $donation->amount = $amount;
        $donation->currency = 'MYR';
        $donation->payment_method = $request->payment_method;
        $donation->payment_status = 'pending';
        $donation->message = $request->message;
        $donation->is_anonymous = $request->has('is_anonymous');
        $donation->save();

        // Redirect to payment page with donation data
        return redirect()->route('payment.page')->with([
            'donation_id' => $donation->id,
            'amount' => $amount,
            'campaign_id' => $request->campaign_id,
            'donor_name' => $request->donor_name,
            'donor_email' => $request->donor_email,
            'donor_phone' => $request->donor_phone,
            'message' => $request->message,
            'is_anonymous' => $request->has('is_anonymous'),
            'payment_method' => $request->payment_method,
            'card_number' => $request->card_number ?? null,
            'card_expiry' => $request->card_expiry ?? null,
            'card_cvv' => $request->card_cvv ?? null,
            'card_holder_name' => $request->card_holder_name ?? null,
            'obw_bank' => $request->obw_bank ?? null,
        ]);
    }
}
