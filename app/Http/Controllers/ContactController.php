<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Store a newly created contact message.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'first-name' => 'required|string|max:255',
            'last-name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:5000',
        ], [
            'first-name.required' => 'First name is required.',
            'last-name.required' => 'Last name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'subject.required' => 'Subject is required.',
            'message.required' => 'Message is required.',
            'message.min' => 'Message must be at least 10 characters long.',
            'message.max' => 'Message cannot exceed 5000 characters.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please correct the errors below.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create the contact message
            $contact = Contact::create([
                'name' => $request->input('first-name') . ' ' . $request->input('last-name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject' => $request->input('subject'),
                'message' => $request->input('message'),
                'status' => 'unread',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We\'ll get back to you within 24 hours.',
                'contact_id' => $contact->id
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error sending your message. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 