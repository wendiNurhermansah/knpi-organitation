<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Switch language between Indonesian ('id') and English ('en').
     */
    public function switch(Request $request, string $locale): RedirectResponse
    {
        if (in_array($locale, ['id', 'en'])) {
            session(['locale' => $locale]);
        }

        return redirect()->back(fallback: route('home'));
    }
}
