<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AspirationController extends Controller
{
    /**
     * Display listing of aspirations with filter.
     */
    public function index(Request $request): View
    {
        $status = $request->get('status');
        $search = $request->get('q');
        $category = $request->get('category');

        $query = Aspiration::with('handler');

        if (in_array($status, ['submitted', 'in_review', 'resolved'])) {
            $query->where('status', $status);
        }

        if (!empty($category)) {
            $query->where('category', $category);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('ticket_code', 'like', "%{$search}%")
                  ->orWhere('sender_name', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $aspirations = $query->latest()->paginate(10)->withQueryString();

        $stats = [
            'total' => Aspiration::count(),
            'submitted' => Aspiration::where('status', 'submitted')->count(),
            'in_review' => Aspiration::where('status', 'in_review')->count(),
            'resolved' => Aspiration::where('status', 'resolved')->count(),
        ];

        return view('admin.aspirations.index', [
            'aspirations' => $aspirations,
            'currentStatus' => $status,
            'search' => $search,
            'category' => $category,
            'stats' => $stats,
        ]);
    }

    /**
     * Update status and official notes for a ticket.
     * Route: PATCH /admin/aspirasi/{aspiration}
     */
    public function update(Request $request, Aspiration $aspiration): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:submitted,in_review,resolved'],
            'admin_notes' => ['nullable', 'string'],
        ], [
            'status.required' => 'Status tiket wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ]);

        $aspiration->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $aspiration->admin_notes,
            'handled_by' => auth()->id(),
        ]);

        $statusText = match ($validated['status']) {
            'in_review' => 'Sedang Diproses (In Review)',
            'resolved' => 'Selesai Ditindaklanjuti (Resolved)',
            default => 'Diterima (Submitted)',
        };

        return back()->with('success', "Tiket [{$aspiration->ticket_code}] berhasil diperbarui menjadi status: {$statusText}.");
    }
}
