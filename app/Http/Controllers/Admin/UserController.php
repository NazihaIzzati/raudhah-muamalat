<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Staff;
use App\Models\Donor;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with(['staff', 'donor']);
        
        // Filter by user type
        if ($request->filled('user_type')) {
            $query->where('user_type', $request->user_type);
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }
        
        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $users = $query->latest()->paginate(10);
        
        $userTypes = [
            '' => 'All Types',
            'staff' => 'Staff',
            'donor' => 'Donor'
        ];
        
        $statuses = [
            '' => 'All Statuses',
            'active' => 'Active',
            'inactive' => 'Inactive'
        ];
        
        return view('admin.users.index', compact('users', 'userTypes', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userTypes = [
            'staff' => 'Staff',
            'donor' => 'Donor'
        ];
        
        $staffRoles = [
            'hq' => 'HQ',
            'admin' => 'Admin',
            'manager' => 'Manager',
            'staff' => 'Staff'
        ];
        
        $donorTypes = [
            'individual' => 'Individual',
            'corporate' => 'Corporate',
            'anonymous' => 'Anonymous'
        ];
        
        return view('admin.users.create', compact('userTypes', 'staffRoles', 'donorTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => ['required', Rule::in(['staff', 'donor'])],
            'is_active' => 'boolean',
            
            // Staff specific fields
            'employee_id' => 'nullable|string|max:50',
            'position' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|max:2048',
            'role' => ['nullable', Rule::in(['hq', 'admin', 'manager', 'staff'])],
            'status' => ['nullable', Rule::in(['active', 'inactive', 'terminated'])],
            'hire_date' => 'nullable|date',
            'termination_date' => 'nullable|date|after:hire_date',
            'notes' => 'nullable|string|max:1000',
            
            // Donor specific fields
            'donor_id' => 'nullable|string|max:50',
            'identification_number' => 'nullable|string|max:50',
            'donor_type' => ['nullable', Rule::in(['individual', 'corporate', 'anonymous'])],
            'donor_status' => ['nullable', Rule::in(['active', 'inactive', 'suspended'])],
            'registration_date' => 'nullable|date',
            'newsletter_subscribed' => 'boolean',
            'preferences' => 'nullable|array',
        ]);
        
        // Handle profile picture upload
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile-pictures', 'public');
        }
        
        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'user_type' => $validated['user_type'],
            'is_active' => $validated['is_active'] ?? true,
        ]);
        
        // Create staff or donor profile based on user type
        if ($validated['user_type'] === 'staff') {
            $user->staff()->create([
                'employee_id' => $validated['employee_id'] ?? 'EMP' . strtoupper(Str::random(8)),
                'position' => $validated['position'] ?? null,
                'department' => $validated['department'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
                'profile_picture' => $profilePicturePath,
                'role' => $validated['role'] ?? 'staff',
                'status' => $validated['status'] ?? 'active',
                'hire_date' => $validated['hire_date'] ?? now(),
                'termination_date' => $validated['termination_date'] ?? null,
                'notes' => $validated['notes'] ?? null,
            ]);
        } else {
            $user->donor()->create([
                'donor_id' => $validated['donor_id'] ?? 'DON' . strtoupper(Str::random(8)),
                'identification_number' => $validated['identification_number'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
                'profile_picture' => $profilePicturePath,
                'donor_type' => $validated['donor_type'] ?? 'individual',
                'status' => $validated['donor_status'] ?? 'active',
                'registration_date' => $validated['registration_date'] ?? now(),
                'total_donated' => 0,
                'donation_count' => 0,
                'last_donation_date' => null,
                'newsletter_subscribed' => $validated['newsletter_subscribed'] ?? false,
                'preferences' => $validated['preferences'] ?? [],
                'notes' => $validated['notes'] ?? null,
            ]);
        }
        
        // Create notification for new user creation
        try {
            Notification::createUserRegistrationNotification($user);
        } catch (\Exception $e) {
            // Log error but don't fail the user creation
            \Log::error('Failed to create user registration notification: ' . $e->getMessage());
        }
        
        return redirect()->route('admin.users.show', $user)
            ->with('success', ucfirst($validated['user_type']) . ' created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load(['staff', 'donor', 'donor.donations']);
        
        $donationStats = [
            'total' => 0,
            'total_amount' => 0,
            'average_donation' => 0,
            'last_donation' => null,
        ];
        
        if ($user->isDonor() && $user->donor) {
            $donationStats = [
                'total' => $user->donor->donations->count(),
                'total_amount' => $user->donor->donations->where('payment_status', 'completed')->sum('amount'),
                'average_donation' => $user->donor->donations->where('payment_status', 'completed')->avg('amount') ?? 0,
                'last_donation' => $user->donor->donations->where('payment_status', 'completed')->sortByDesc('created_at')->first(),
            ];
        }
        
        return view('admin.users.show', compact('user', 'donationStats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load(['staff', 'donor']);
        
        $userTypes = [
            'staff' => 'Staff',
            'donor' => 'Donor'
        ];
        
        $staffRoles = [
            'hq' => 'HQ',
            'admin' => 'Admin',
            'manager' => 'Manager',
            'staff' => 'Staff'
        ];
        
        $donorTypes = [
            'individual' => 'Individual',
            'corporate' => 'Corporate',
            'anonymous' => 'Anonymous'
        ];
        
        return view('admin.users.edit', compact('user', 'userTypes', 'staffRoles', 'donorTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'user_type' => ['required', Rule::in(['staff', 'donor'])],
            'is_active' => 'boolean',
            
            // Staff specific fields
            'employee_id' => 'nullable|string|max:50',
            'position' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|max:2048',
            'role' => ['nullable', Rule::in(['hq', 'admin', 'manager', 'staff'])],
            'status' => ['nullable', Rule::in(['active', 'inactive', 'terminated'])],
            'hire_date' => 'nullable|date',
            'termination_date' => 'nullable|date|after:hire_date',
            'notes' => 'nullable|string|max:1000',
            
            // Donor specific fields
            'donor_id' => 'nullable|string|max:50',
            'identification_number' => 'nullable|string|max:50',
            'donor_type' => ['nullable', Rule::in(['individual', 'corporate', 'anonymous'])],
            'donor_status' => ['nullable', Rule::in(['active', 'inactive', 'suspended'])],
            'registration_date' => 'nullable|date',
            'newsletter_subscribed' => 'boolean',
            'preferences' => 'nullable|array',
        ]);
        
        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if exists
            if ($user->staff && $user->staff->profile_picture) {
                Storage::disk('public')->delete($user->staff->profile_picture);
            }
            if ($user->donor && $user->donor->profile_picture) {
                Storage::disk('public')->delete($user->donor->profile_picture);
            }
            
            $profilePicturePath = $request->file('profile_picture')->store('profile-pictures', 'public');
        }
        
        // Update user data
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->user_type = $validated['user_type'];
        $user->is_active = $validated['is_active'] ?? true;
        
        // Update password if provided
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        
        $user->save();
        
        // Handle profile updates based on user type
        if ($validated['user_type'] === 'staff') {
            // Delete donor profile if exists and switching to staff
            if ($user->donor) {
                $user->donor->delete();
            }
            
            // Create or update staff profile
            if ($user->staff) {
                $staffData = [
                    'employee_id' => $validated['employee_id'] ?? $user->staff->employee_id,
                    'position' => $validated['position'] ?? $user->staff->position,
                    'department' => $validated['department'] ?? $user->staff->department,
                    'phone' => $validated['phone'] ?? $user->staff->phone,
                    'address' => $validated['address'] ?? $user->staff->address,
                    'role' => $validated['role'] ?? $user->staff->role,
                    'status' => $validated['status'] ?? $user->staff->status,
                    'hire_date' => $validated['hire_date'] ?? $user->staff->hire_date,
                    'termination_date' => $validated['termination_date'] ?? $user->staff->termination_date,
                    'notes' => $validated['notes'] ?? $user->staff->notes,
                ];
                
                if (isset($profilePicturePath)) {
                    $staffData['profile_picture'] = $profilePicturePath;
                }
                
                $user->staff->update($staffData);
            } else {
                $user->staff()->create([
                    'employee_id' => $validated['employee_id'] ?? 'EMP' . strtoupper(Str::random(8)),
                    'position' => $validated['position'] ?? null,
                    'department' => $validated['department'] ?? null,
                    'phone' => $validated['phone'] ?? null,
                    'address' => $validated['address'] ?? null,
                    'profile_picture' => $profilePicturePath ?? null,
                    'role' => $validated['role'] ?? 'staff',
                    'status' => $validated['status'] ?? 'active',
                    'hire_date' => $validated['hire_date'] ?? now(),
                    'termination_date' => $validated['termination_date'] ?? null,
                    'notes' => $validated['notes'] ?? null,
                ]);
            }
        } else {
            // Delete staff profile if exists and switching to donor
            if ($user->staff) {
                $user->staff->delete();
            }
            
            // Create or update donor profile
            if ($user->donor) {
                $donorData = [
                    'donor_id' => $validated['donor_id'] ?? $user->donor->donor_id,
                    'identification_number' => $validated['identification_number'] ?? $user->donor->identification_number,
                    'phone' => $validated['phone'] ?? $user->donor->phone,
                    'address' => $validated['address'] ?? $user->donor->address,
                    'donor_type' => $validated['donor_type'] ?? $user->donor->donor_type,
                    'status' => $validated['donor_status'] ?? $user->donor->status,
                    'registration_date' => $validated['registration_date'] ?? $user->donor->registration_date,
                    'newsletter_subscribed' => $validated['newsletter_subscribed'] ?? $user->donor->newsletter_subscribed,
                    'preferences' => $validated['preferences'] ?? $user->donor->preferences,
                ];
                
                if (isset($profilePicturePath)) {
                    $donorData['profile_picture'] = $profilePicturePath;
                }
                
                $user->donor->update($donorData);
            } else {
                $user->donor()->create([
                    'donor_id' => $validated['donor_id'] ?? 'DON' . strtoupper(Str::random(8)),
                    'identification_number' => $validated['identification_number'] ?? null,
                    'phone' => $validated['phone'] ?? null,
                    'address' => $validated['address'] ?? null,
                    'profile_picture' => $profilePicturePath ?? null,
                    'donor_type' => $validated['donor_type'] ?? 'individual',
                    'status' => $validated['donor_status'] ?? 'active',
                    'registration_date' => $validated['registration_date'] ?? now(),
                    'total_donated' => 0,
                    'donation_count' => 0,
                    'last_donation_date' => null,
                    'newsletter_subscribed' => $validated['newsletter_subscribed'] ?? false,
                    'preferences' => $validated['preferences'] ?? [],
                    'notes' => $validated['notes'] ?? null,
                ]);
            }
        }
        
        return redirect()->route('admin.users.show', $user)
            ->with('success', ucfirst($validated['user_type']) . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent self-deletion
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }
        
        // Delete profile pictures if exist
        if ($user->staff && $user->staff->profile_picture) {
            Storage::disk('public')->delete($user->staff->profile_picture);
        }
        if ($user->donor && $user->donor->profile_picture) {
            Storage::disk('public')->delete($user->donor->profile_picture);
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
