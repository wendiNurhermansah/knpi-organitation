<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAspirationRequest;
use App\Models\Aspiration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AspirationController extends Controller
{
    /**
     * Store a newly submitted youth aspiration.
     */
    public function store(StoreAspirationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Generate unique ticket code: KNPI-YYYYMM-XXXX
        $ticketCode = Aspiration::generateTicketCode();

        // Handle optional attachment upload
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('aspirations', 'public');
        }

        $aspiration = Aspiration::create([
            'ticket_code' => $ticketCode,
            'sender_name' => strip_tags($validated['sender_name']),
            'sender_email' => filter_var($validated['sender_email'], FILTER_SANITIZE_EMAIL),
            'category' => strip_tags($validated['category']),
            'subject' => strip_tags($validated['subject']),
            'message' => strip_tags($validated['message']),
            'status' => 'submitted',
            'attachment' => $attachmentPath,
        ]);

        return redirect()->route('aspirasi.track', ['ticket_code' => $ticketCode])
            ->with('success', "Aspirasi Anda berhasil dikirim! Simpan Kode Tiket Anda untuk melacak perkembangan tindak lanjut.")
            ->with('ticket_code', $ticketCode);
    }

    /**
     * Track status of an aspiration by ticket code.
     */
    public function track(Request $request): View
    {
        $ticketCode = trim($request->get('ticket_code', ''));
        $aspiration = null;

        if (!empty($ticketCode)) {
            $aspiration = Aspiration::with('handler')
                ->where('ticket_code', $ticketCode)
                ->first();
        }

        return view('aspirations.track', [
            'ticketCode' => $ticketCode,
            'aspiration' => $aspiration,
            'searched' => !empty($ticketCode),
        ]);
    }
}
