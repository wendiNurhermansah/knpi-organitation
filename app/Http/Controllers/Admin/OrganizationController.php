<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\VerifyOrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OrganizationController extends Controller
{
    /**
     * Display a listing of OKPs with status filtering.
     */
    public function index(Request $request): View
    {
        $status = $request->get('status');
        $search = $request->get('q');

        $query = Organization::query();

        if (in_array($status, ['pending', 'verified', 'expired'])) {
            $query->where('status', $status);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('leader_name', 'like', "%{$search}%")
                  ->orWhere('sk_number', 'like', "%{$search}%");
            });
        }

        $organizations = $query->latest()->paginate(10)->withQueryString();

        $counts = [
            'all' => Organization::count(),
            'pending' => Organization::where('status', 'pending')->count(),
            'verified' => Organization::where('status', 'verified')->count(),
            'expired' => Organization::where('status', 'expired')->count(),
        ];

        return view('admin.organizations.index', [
            'organizations' => $organizations,
            'currentStatus' => $status,
            'search' => $search,
            'counts' => $counts,
        ]);
    }

    /**
     * Show form to create a new OKP.
     */
    public function create(): View
    {
        return view('admin.organizations.create');
    }

    /**
     * Store a newly created OKP in storage.
     */
    public function store(StoreOrganizationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('sk_file')) {
            $validated['sk_file'] = $request->file('sk_file')->store('sk_documents', 'public');
        }

        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(4);

        Organization::create($validated);

        return redirect()->route('admin.okp.index')
            ->with('success', "OKP '{$validated['name']}' berhasil didaftarkan ke sistem.");
    }

    /**
     * Show the edit form for an OKP.
     */
    public function edit(Organization $organization): View
    {
        return view('admin.organizations.edit', [
            'organization' => $organization,
        ]);
    }

    /**
     * Update the specified OKP.
     */
    public function update(StoreOrganizationRequest $request, Organization $organization): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('sk_file')) {
            $validated['sk_file'] = $request->file('sk_file')->store('sk_documents', 'public');
        }

        $organization->update($validated);

        return redirect()->route('admin.okp.index')
            ->with('success', "Data OKP '{$organization->name}' berhasil diperbarui.");
    }

    /**
     * Custom Action: Quick verify / update verification status of an OKP.
     * Route: PATCH /admin/okp/{organization}/verify
     */
    public function verify(VerifyOrganizationRequest $request, Organization $organization): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('sk_file')) {
            $validated['sk_file'] = $request->file('sk_file')->store('sk_documents', 'public');
        }

        $organization->update($validated);

        $statusText = match ($organization->status) {
            'verified' => 'Terverifikasi (Aktif)',
            'expired' => 'Kedaluwarsa',
            default => 'Menunggu Verifikasi',
        };

        return back()->with('success', "Status legalitas OKP '{$organization->name}' diperbarui menjadi {$statusText}.");
    }

    /**
     * Remove the specified OKP from storage.
     */
    public function destroy(Organization $organization): RedirectResponse
    {
        $name = $organization->name;
        $organization->delete();

        return redirect()->route('admin.okp.index')
            ->with('success', "Data OKP '{$name}' telah dihapus.");
    }
}
