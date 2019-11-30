<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public const LOCALE_TO_COUNTRY_CODE = [
        'en' => 'gb',
        'pt' => 'pt',
        'fr' => 'fr'
    ];

    public function update(Request $request, $locale)
    {
        if (in_array($locale, config('custom.available_locales'))) {
            $newLocale = $locale;
        } else {
            $newLocale = config('app.locale');
        }

        $request->session()->flash('locale', $newLocale);
        $cookie = cookie('locale', $newLocale, 525948);

        return redirect()->back()->cookie($cookie);
    }
}
