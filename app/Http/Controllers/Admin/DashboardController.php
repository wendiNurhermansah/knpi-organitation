<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Aspiration;
use App\Models\Event;
use App\Models\Organization;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the Paper Admin dashboard with aggregate metrics and recent tables.
     */
    public function index(): View
    {
        $verifiedOkpCount = Organization::where('status', 'verified')->count();
        $pendingOkpCount = Organization::where('status', 'pending')->count();
        $totalNewsCount = Article::where('status', 'published')->count();
        $pendingAspirationCount = Aspiration::whereIn('status', ['submitted', 'in_review'])->count();
        $totalAspirationCount = Aspiration::count();
        $upcomingEventsCount = Event::where('start_time', '>=', now())->count();

        // Recent OKP verification list
        $recentOrganizations = Organization::latest()
            ->take(7)
            ->get();

        // Active youth aspiration tickets
        $activeAspirations = Aspiration::with('handler')
            ->latest()
            ->take(7)
            ->get();

        return view('admin.dashboard', [
            'verifiedOkpCount' => $verifiedOkpCount,
            'pendingOkpCount' => $pendingOkpCount,
            'totalNewsCount' => $totalNewsCount,
            'pendingAspirationCount' => $pendingAspirationCount,
            'totalAspirationCount' => $totalAspirationCount,
            'upcomingEventsCount' => $upcomingEventsCount,
            'recentOrganizations' => $recentOrganizations,
            'activeAspirations' => $activeAspirations,
        ]);
    }
}
