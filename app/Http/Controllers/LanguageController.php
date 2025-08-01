<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch the application language
     *
     * @param  string  $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchLanguage($locale)
    {
        // Validate locale
        if (!in_array($locale, ['en', 'ms'])) {
            $locale = 'en'; // Default to English if invalid locale
        }

        // Store the locale in the session
        Session::put('locale', $locale);
        App::setLocale($locale);

        return redirect()->back();
    }
} 