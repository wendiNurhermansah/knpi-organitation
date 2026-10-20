<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index(Request $request): View
    {
        $search = $request->get('q');
        $query = Event::withCount('registrations');

        if (!empty($search)) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
        }

        $events = $query->latest('start_time')->paginate(10)->withQueryString();

        return view('admin.events.index', compact('events', 'search'));
    }

    /**
     * Show form for creating a new event.
     */
    public function create(): View
    {
        return view('admin.events.create');
    }

    /**
     * Store a new event.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date', 'after:start_time'],
            'quota' => ['required', 'integer', 'min:1'],
            'banner_image' => ['nullable', 'image', 'max:4096'],
            'is_open_registration' => ['boolean'],
        ]);

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('events', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(4);
        $validated['is_open_registration'] = $request->boolean('is_open_registration', true);

        Event::create($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda pemuda berhasil ditambahkan ke kalender kegiatan.');
    }

    /**
     * Show form for editing an event.
     */
    public function edit(Event $event): View
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the event.
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date', 'after:start_time'],
            'quota' => ['required', 'integer', 'min:1'],
            'banner_image' => ['nullable', 'image', 'max:4096'],
            'is_open_registration' => ['boolean'],
        ]);

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('events', 'public');
        }

        $validated['is_open_registration'] = $request->boolean('is_open_registration', false);

        $event->update($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda pemuda berhasil diperbarui.');
    }

    /**
     * Show registrations of an event.
     */
    public function show(Event $event): View
    {
        $registrations = $event->registrations()->latest()->paginate(20);
        return view('admin.events.show', compact('event', 'registrations'));
    }

    /**
     * Remove the specified event.
     */
    public function destroy(Event $event): RedirectResponse
    {
        $title = $event->title;
        $event->delete();

        return redirect()->route('admin.agenda.index')
            ->with('success', "Agenda '{$title}' berhasil dihapus.");
    }
}
