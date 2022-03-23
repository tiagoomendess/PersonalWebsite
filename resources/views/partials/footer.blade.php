<div id="footer" class="hide">
    @foreach(config('custom.available_locales') as $locale)
        <a class="locale-flags" href="{{ route('set_locale', ['locale' => $locale]) }}">
            <img
                    class="{{ $locale == \Illuminate\Support\Facades\App::getLocale() ? 'locale-flag-selected' : 'locale-not-flag-selected' }}"
                    src="https://flagcdn.com/h40/{{ \App\Http\Controllers\LocaleController::LOCALE_TO_COUNTRY_CODE[$locale] }}.png">
        </a>
    @endforeach
</div>
