<?php

namespace App\Http\Controllers;

use App\Models\Official;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display Sejarah (History) page.
     */
    public function sejarah(): View
    {
        return view('profile.sejarah');
    }

    /**
     * Display Visi & Misi (Vision & Mission) page.
     */
    public function visiMisi(): View
    {
        return view('profile.visi-misi');
    }

    /**
     * Display AD / ART (Constitution & Bylaws) page.
     */
    public function adArt(): View
    {
        return view('profile.ad-art');
    }

    /**
     * Display Pengurus (Executive Board / Officials) page.
     */
    public function pengurus(): View
    {
        $officials = Official::active()->get();

        return view('profile.pengurus', compact('officials'));
    }
}
