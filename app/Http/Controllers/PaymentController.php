<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Services\CardZoneService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Process a donation payment using Cardzone
     *
     * @param Request $request
     * @param int $donationId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processCardzone(Request $request, $donationId)
    {
        $donation = Donation::findOrFail($donationId);
        
        // Check if donation is already paid
        if ($donation->payment_status === 'completed') {
            return redirect()->route('donation.success', ['id' => $donation->id])
                ->with('message', 'This donation has already been processed.');
        }
        
        // Update payment method if not set
        if ($donation->payment_method !== 'cardzone') {
            $donation->payment_method = 'cardzone';
            $donation->save();
        }
        
        $cardZoneService = new CardZoneService();
        $paymentUrl = $cardZoneService->generatePaymentUrl($donation);
        
        if (!$paymentUrl) {
            return redirect()->back()
                ->with('error', 'Unable to process payment at this time. Please try again later.');
        }
        
        // Redirect to Cardzone payment page
        return redirect()->away($paymentUrl);
    }
    
    /**
     * Handle the callback from Cardzone payment gateway
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function cardzoneCallback(Request $request)
    {
        Log::info('Cardzone Callback Received', ['data' => $request->all()]);
        
        $cardZoneService = new CardZoneService();
        $success = $cardZoneService->processCallback($request->all());
        
        // Return appropriate response to Cardzone
        if ($success) {
            return response('OK', 200);
        } else {
            return response('Error processing payment', 500);
        }
    }
    
    /**
     * Handle the return from Cardzone payment gateway
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cardzoneReturn(Request $request)
    {
        $donationId = $request->query('donation_id');
        $donation = Donation::find($donationId);
        
        if (!$donation) {
            return redirect()->route('home')
                ->with('error', 'Donation not found.');
        }
        
        if ($donation->payment_status === 'completed') {
            return redirect()->route('donation.success', ['id' => $donation->id])
                ->with('success', 'Your donation has been processed successfully. Thank you for your generosity!');
        } elseif ($donation->payment_status === 'pending') {
            return redirect()->route('donation.pending', ['id' => $donation->id])
                ->with('info', 'Your donation is being processed. We will notify you once it is completed.');
        } else {
            return redirect()->route('donation.failed', ['id' => $donation->id])
                ->with('error', 'Your donation could not be processed. Please try again or contact support.');
        }
    }
    
    /**
     * Display donation success page
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function success($id)
    {
        $donation = Donation::with('campaign')->findOrFail($id);
        return view('payment.success', compact('donation'));
    }
    
    /**
     * Display donation pending page
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function pending($id)
    {
        $donation = Donation::with('campaign')->findOrFail($id);
        return view('payment.pending', compact('donation'));
    }
    
    /**
     * Display donation failed page
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function failed($id)
    {
        $donation = Donation::with('campaign')->findOrFail($id);
        return view('payment.failed', compact('donation'));
    }
} 