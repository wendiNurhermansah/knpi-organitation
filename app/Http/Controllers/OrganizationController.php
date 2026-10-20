<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrganizationController extends Controller
{
    /**
     * Display public OKP (Organisasi Kemasyarakatan Pemuda) directory showcase.
     */
    public function index(Request $request): View
    {
        $search = $request->get('q');
        $status = $request->get('status', 'verified'); // default show verified

        $query = Organization::query();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('leader_name', 'like', "%{$search}%")
                  ->orWhere('sk_number', 'like', "%{$search}%");
            });
        }

        $organizations = $query->orderBy('name', 'asc')->paginate(12)->withQueryString();

        $stats = [
            'total_verified' => Organization::where('status', 'verified')->count(),
            'total_pending' => Organization::where('status', 'pending')->count(),
        ];

        return view('organizations.index', compact('organizations', 'search', 'status', 'stats'));
    }
}
