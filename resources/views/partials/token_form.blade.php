@if(!empty($errors))
    <ul>
        @foreach($errors as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form method="POST" action="{{ isset($route) ? $route : route('tokens.store') }}">

    {{ csrf_field() }}
    @if(isset($method))
        {{ method_field($method) }}
    @endif

    <div class="row">
        <div class="input-field col s12">
            <input required name="token" {{ isset($token) ? 'disabled' : '' }} class="white-text" placeholder="Token" id="token" type="text" value="{{ isset($token) ? $token : \Illuminate\Support\Str::random(9) }}">
            <label class="white-text" for="token">{{ trans('general.token', ['token' => ' ']) }}</label>
        </div>
    </div>

    <div class="row">
        <div class="input-field col s6">
            <input required disabled name="download_count" class="white-text" placeholder="Download Count" id="download_count" type="number" value="{{ isset($download_count) ? $download_count : 0 }}">
            <label class="white-text" for="download_count">{{ trans('general.downloads') }}</label>
        </div>

        <div class="input-field col s6">
            <input required name="max_download" class="white-text" placeholder="Max Downloads" id="max_download" type="number" value="{{ isset($max_download) ? $max_download : '' }}">
            <label class="white-text" for="max_download">{{ trans('general.max_downloads') }}</label>
        </div>
    </div>

    <div class="row">
        <div class="input-field col s12">
            <select name="locale">
                @foreach(config('custom.available_locales') as $key => $locale)
                    @if((!isset($tokenLocale) && $key == 0) || (isset($tokenLocale) && $tokenLocale == $locale))
                        <option
                                data-icon="https://flagcdn.com/h20/{{ \App\Http\Controllers\LocaleController::LOCALE_TO_COUNTRY_CODE[$locale] }}.png"
                                value="{{ $locale }}" selected>{{ trans_choice('general.locale', $locale) }}</option>
                    @else
                        <option
                                data-icon="https://flagcdn.com/h20/{{ \App\Http\Controllers\LocaleController::LOCALE_TO_COUNTRY_CODE[$locale] }}.png"
                                value="{{ $locale }}">{{ trans_choice('general.locale', $locale) }}</option>
                    @endif
                @endforeach
            </select>
            <label class="white-text">{{ trans('general.language') }}</label>
        </div>
    </div>

    <a href="{{ route('tokens.index') }}" class="waves-effect waves-light btn white black-text"><i class="material-icons left">arrow_back</i>{{ trans('general.go_back') }}</a>
    <button class="btn green right" type="submit" name="action"><i class="material-icons right">save</i> {{ trans('general.save') }}</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        M.FormSelect.init(elems, {});
    });
</script>
