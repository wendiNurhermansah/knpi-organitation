<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRegistrationRequest;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\RedirectResponse;

class EventRegistrationController extends Controller
{
    /**
     * Store registration of a participant for a specific agenda.
     */
    public function store(StoreEventRegistrationRequest $request, Event $event): RedirectResponse
    {
        if (!$event->is_open_registration) {
            return back()->with('error', 'Mohon maaf, pendaftaran untuk agenda ini telah ditutup.');
        }

        if ($event->remaining_quota <= 0) {
            return back()->with('error', 'Mohon maaf, kuota peserta untuk kegiatan ini sudah terpenuhi.');
        }

        // Check if NIK or Email already registered for this event
        $exists = EventRegistration::where('event_id', $event->id)
            ->where(function ($q) use ($request) {
                $q->where('nik', $request->nik)
                  ->orWhere('email', $request->email);
            })->exists();

        if ($exists) {
            return back()->with('error', 'NIK atau Email ini sudah terdaftar pada agenda ini.');
        }

        $validated = $request->validated();
        $validated['event_id'] = $event->id;
        $validated['status'] = 'registered';

        EventRegistration::create($validated);

        return back()->with('success', "Selamat, Anda berhasil terdaftar pada kegiatan '{$event->title}'. Harap simpan bukti pendaftaran ini.");
    }
}
