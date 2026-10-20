<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show modern admin login view with Captcha generation.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        $this->generateNewCaptcha();

        return view('auth.login', [
            'captchaQuestion' => session('captcha_question'),
        ]);
    }

    /**
     * Refresh Captcha endpoint via AJAX/JSON.
     */
    public function refreshCaptcha(): JsonResponse
    {
        $this->generateNewCaptcha();

        return response()->json([
            'question' => session('captcha_question'),
        ]);
    }

    /**
     * Generate random math captcha challenge.
     */
    protected function generateNewCaptcha(): void
    {
        $num1 = rand(3, 9);
        $num2 = rand(1, 8);
        $answer = $num1 + $num2;

        session([
            'captcha_question' => "{$num1} + {$num2}",
            'captcha_answer' => $answer,
        ]);
    }

    /**
     * Handle admin login authentication with Captcha verification.
     */
    public function login(Request $request): RedirectResponse
    {
        // Strict Validation including Captcha
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'captcha' => ['required', function ($attribute, $value, $fail) {
                $expected = session('captcha_answer');
                if (is_null($expected) || (int)$value !== (int)$expected) {
                    $fail('Hasil perhitungan Captcha tidak cocok. Silakan coba lagi.');
                }
            }],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
            'captcha.required' => 'Verifikasi Captcha keamanan wajib diisi.',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $request->session()->forget(['captcha_answer', 'captcha_question']);

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang di Paper Admin KNPI Digital Ecosystem.');
        }

        // Regenerate captcha on failed attempt
        $this->generateNewCaptcha();

        return back()->withErrors([
            'email' => 'Alamat email atau kata sandi tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}
