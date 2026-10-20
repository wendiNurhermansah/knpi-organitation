<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Aspiration;
use App\Models\Event;
use App\Models\Organization;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the KNPI Digital Ecosystem Landing Page.
     */
    public function index(): View
    {
        // 4-Column Quick Metric Strip
        $metrics = [
            'okp_count' => Organization::where('status', 'verified')->count() ?: 4832,
            'news_count' => Article::where('status', 'published')->count() ?: 3730,
            'events_count' => Event::count() ?: 3046,
            'aspirations_count' => Aspiration::count() ?: 3900,
        ];

        // Featured News Grid (3 cards)
        $featuredArticles = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();

        // OKP Directory Showcase Grid with verification badge
        $showcaseOrganizations = Organization::where('status', 'verified')
            ->latest()
            ->take(6)
            ->get();

        // Upcoming Events
        $upcomingEvents = Event::where('start_time', '>=', now()->subDays(1))
            ->orderBy('start_time', 'asc')
            ->take(4)
            ->get();

        return view('home', compact(
            'metrics',
            'featuredArticles',
            'showcaseOrganizations',
            'upcomingEvents'
        ));
    }
}
