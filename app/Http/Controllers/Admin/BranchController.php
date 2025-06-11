<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Branch::query()->with('creator');
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Search by name, code, or city
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }
        
        $branches = $query->orderBy('name')->paginate(10);
        $statuses = [
            '' => 'All Statuses',
            'active' => 'Active',
            'inactive' => 'Inactive'
        ];
        
        return view('admin.branches.index', compact('branches', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:branches',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'manager_name' => 'nullable|string|max:255',
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'description' => 'nullable|string',
            'opening_hours' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);
        
        // Create branch
        $branch = Branch::create([
            ...$validated,
            'created_by' => auth()->id(),
        ]);
        
        return redirect()->route('admin.branches.show', $branch)
            ->with('success', 'Branch created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        $branch->load('creator');
        $donationCount = $branch->donations()->count();
        $totalDonations = $branch->donations()->where('payment_status', 'completed')->sum('amount');
        
        return view('admin.branches.show', compact('branch', 'donationCount', 'totalDonations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view('admin.branches.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => ['required', 'string', 'max:50', Rule::unique('branches')->ignore($branch->id)],
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'manager_name' => 'nullable|string|max:255',
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'description' => 'nullable|string',
            'opening_hours' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);
        
        // Update branch
        $branch->update($validated);
        
        return redirect()->route('admin.branches.show', $branch)
            ->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        // Check if branch has associated donations
        $donationCount = $branch->donations()->count();
        
        if ($donationCount > 0) {
            return redirect()->route('admin.branches.show', $branch)
                ->with('error', "Cannot delete branch with {$donationCount} associated donations.");
        }
        
        $branch->delete();
        
        return redirect()->route('admin.branches.index')
            ->with('success', 'Branch deleted successfully.');
    }
}
