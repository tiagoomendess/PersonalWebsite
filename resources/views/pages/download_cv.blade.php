@extends('layouts.default')

@section('default-head')
    <title>{{ env('APP_NAME') }}</title>
@endsection

@section('default-body')

    @include('partials.particles')
    @include('partials.loading-screen')

    <div class="page">
        <section class="info">
            @if($canDownload)
                <span style="font-size: 6rem">&#x1F60A;</span>
                <p class="flow-text" style="margin-bottom: 20px">{{ trans('general.thanks_download') }}</p>
                <div style="height: 37px">
                    <a href="{{ route('home') }}" id="go_back_download"
                       class="waves-effect waves-light btn black-text white fade-out">{{ trans('general.go_back') }}</a>
                </div>
                <script>
                    setTimeout(function () {
                        setTimeout(function () {
                            document.getElementById('go_back_download').classList.remove('fade-out');
                            document.getElementById('go_back_download').classList.add('fade-in');
                        }, 2000);

                        window.location.href = '{{ route('cv_download', [
                            'token' => $token,
                            'random_string' => \Illuminate\Support\Str::random(12)
                        ]) }}';
                    }, 1500);
                </script>
            @else
                @if(empty($token))
                    <p class="flow-text">{{ trans('general.ask_for_token') }} &#128521;</p>
                    <form action="{{ route('cv') }}" method="GET">
                        <div class="row">
                            <div class="col s12">
                                <div class="input-field inline white-text">
                                    <!-- If you really want my CV just send me an email. I'll send you a token -->
                                    <input name="token" id="token" type="text" class="white-text" autocomplete="off">
                                    <label for="token" class="white-text">{{ trans('general.download_token') }}</label>
                                </div>
                                <button class="btn waves-effect waves-light white black-text" type="submit"
                                        name="action">{{ trans('general.download') }}</button>
                            </div>
                        </div>
                    </form>
                @else
                    <p class="flow-text" style="margin-bottom: 20px">{{ trans('general.invalid_token') }} &#128546;</p>
                    <a href="{{ route('home') }}"
                       class="waves-effect waves-light btn black-text white">{{ trans('general.go_back') }}</a>
                @endif
            @endif
        </section>
        @include('partials.footer')
    </div>
@endsection