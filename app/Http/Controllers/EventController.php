<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display public upcoming youth agenda and programs.
     */
    public function index(Request $request): View
    {
        $events = Event::withCount('registrations')
            ->where('start_time', '>=', now()->subDays(7))
            ->orderBy('start_time', 'asc')
            ->paginate(9);

        return view('events.index', compact('events'));
    }
}
