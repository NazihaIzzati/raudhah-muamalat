<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the contacts.
     */
    public function index(Request $request)
    {
        $query = Contact::with('repliedBy')->whereNull('deleted_at');
        
        // Filter by status if provided
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        // Filter by urgent if provided
        if ($request->has('urgent') && $request->urgent == '1') {
            $query->where('is_urgent', true);
        }
        
        // Search by name, email, or subject
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }
        
        // Default sorting
        $query->orderBy('created_at', 'desc');
        
        $contacts = $query->paginate(10)->withQueryString();
        $statuses = [
            'all' => 'All Status',
            'new' => 'New',
            'read' => 'Read',
            'replied' => 'Replied',
            'closed' => 'Closed'
        ];
        
        return view('admin.contacts.index', compact('contacts', 'statuses'));
    }
    
    /**
     * Display trashed contacts.
     */
    public function trashed(Request $request)
    {
        $query = Contact::with('repliedBy')->onlyTrashed();
        
        // Filter by status if provided
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        // Filter by urgent if provided
        if ($request->has('urgent') && $request->urgent == '1') {
            $query->where('is_urgent', true);
        }
        
        // Search by name, email, or subject
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }
        
        // Default sorting
        $query->orderBy('deleted_at', 'desc');
        
        $contacts = $query->paginate(10)->withQueryString();
        $statuses = [
            'all' => 'All Status',
            'new' => 'New',
            'read' => 'Read',
            'replied' => 'Replied',
            'closed' => 'Closed'
        ];
        
        return view('admin.contacts.trashed', compact('contacts', 'statuses'));
    }
    
    /**
     * Display the specified contact.
     */
    public function show(Contact $contact)
    {
        $contact->load('repliedBy');
        
        // Mark as read if it's new
        if ($contact->status === 'new') {
            $contact->update(['status' => 'read']);
        }
        
        return view('admin.contacts.show', compact('contact'));
    }
    
    /**
     * Show the form for editing the specified contact.
     */
    public function edit(Contact $contact)
    {
        $contact->load('repliedBy');
        $statuses = [
            'new' => 'New',
            'read' => 'Read',
            'replied' => 'Replied',
            'closed' => 'Closed'
        ];
        
        return view('admin.contacts.edit', compact('contact', 'statuses'));
    }
    
    /**
     * Update the specified contact in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:new,read,replied,closed',
            'is_urgent' => 'boolean',
            'admin_notes' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Update contact
        $updateData = [
            'status' => $request->status,
            'is_urgent' => $request->has('is_urgent'),
            'admin_notes' => $request->admin_notes,
        ];
        
        // If status is being changed to replied, set replied_by and replied_at
        if ($request->status === 'replied' && $contact->status !== 'replied') {
            $updateData['replied_by'] = Auth::id();
            $updateData['replied_at'] = now();
        }
        
        $contact->update($updateData);
        
        return redirect()->route('admin.contacts.show', $contact)
            ->with('success', 'Contact updated successfully.');
    }
    
    /**
     * Remove the specified contact from storage (soft delete).
     */
    public function destroy(Contact $contact)
    {
        $contactName = $contact->full_name;
        $contact->delete();
        
        return redirect()->route('admin.contacts.index')
            ->with('success', "Contact \"{$contactName}\" moved to trash successfully!");
    }
    
    /**
     * Restore the specified contact from trash.
     */
    public function restore($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contactName = $contact->full_name;
        $contact->restore();
        
        return redirect()->route('admin.contacts.index')
            ->with('success', "Contact \"{$contactName}\" restored successfully!");
    }
    
    /**
     * Permanently delete the specified contact.
     */
    public function forceDelete($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contactName = $contact->full_name;
        $contact->forceDelete();
        
        return redirect()->route('admin.contacts.trashed')
            ->with('success', "Contact \"{$contactName}\" permanently deleted successfully!");
    }
    
    /**
     * Mark contact as urgent.
     */
    public function markUrgent(Contact $contact)
    {
        $contact->update(['is_urgent' => true]);
        
        return redirect()->back()
            ->with('success', 'Contact marked as urgent.');
    }
    
    /**
     * Remove urgent status from contact.
     */
    public function removeUrgent(Contact $contact)
    {
        $contact->update(['is_urgent' => false]);
        
        return redirect()->back()
            ->with('success', 'Urgent status removed from contact.');
    }
    
    /**
     * Mark contact as replied.
     */
    public function markReplied(Contact $contact)
    {
        $contact->update([
            'status' => 'replied',
            'replied_by' => Auth::id(),
            'replied_at' => now(),
        ]);
        
        return redirect()->back()
            ->with('success', 'Contact marked as replied.');
    }
} 