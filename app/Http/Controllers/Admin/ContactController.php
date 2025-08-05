<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Staff;
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
        $query = Contact::query();
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Filter by urgent status
        if ($request->filled('urgent')) {
            $query->where('is_urgent', $request->urgent === 'true');
        }
        
        $contacts = $query->latest()->paginate(15);
        
        $statuses = [
            '' => 'All Statuses',
            'unread' => 'Unread',
            'read' => 'Read',
            'replied' => 'Replied',
            'closed' => 'Closed',
        ];
        
        return view('admin.contacts.index', compact('contacts', 'statuses'));
    }
    
    /**
     * Display trashed contacts.
     */
    public function trashed(Request $request)
    {
        $query = Contact::onlyTrashed();
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Filter by urgent status
        if ($request->filled('urgent')) {
            $query->where('is_urgent', $request->urgent === 'true');
        }
        
        $contacts = $query->latest()->paginate(15);
        
        $statuses = [
            '' => 'All Statuses',
            'unread' => 'Unread',
            'read' => 'Read',
            'replied' => 'Replied',
            'closed' => 'Closed',
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
            'status' => 'required|in:unread,read,replied,closed',
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
            'admin_notes' => $request->admin_notes,
        ];
        
        $contact->update($updateData);
        
        return redirect()->route('admin.contacts.show', $contact)
            ->with('success', 'Contact updated successfully.');
    }
    
    /**
     * Remove the specified contact from storage (soft delete).
     */
    public function destroy(Contact $contact)
    {
        $contactName = $contact->name;
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
        $contactName = $contact->name;
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
        $contactName = $contact->name;
        $contact->forceDelete();
        
        return redirect()->route('admin.contacts.trashed')
            ->with('success', "Contact \"{$contactName}\" permanently deleted successfully!");
    }
    
    /**
     * Mark contact as replied.
     */
    public function markReplied(Contact $contact)
    {
        $contact->update([
            'status' => 'replied',
        ]);
        
        return redirect()->back()
            ->with('success', 'Contact marked as replied.');
    }

    /**
     * Mark contact as urgent.
     */
    public function markUrgent(Contact $contact)
    {
        $contact->update([
            'is_urgent' => !$contact->is_urgent,
        ]);
        
        $status = $contact->is_urgent ? 'marked as urgent' : 'unmarked as urgent';
        
        return redirect()->back()
            ->with('success', "Contact {$status} successfully.");
    }
} 