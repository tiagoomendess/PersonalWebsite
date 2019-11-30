@extends('layouts.default')

@section('default-head')
    <title>{{ env('APP_NAME') }}</title>
@endsection

@section('default-body')

    @include('partials.particles')
    @include('partials.loading-screen')

    <div class="page">
        <section class="info">
            @if(empty($token))
                <p class="flow-text">{{ trans('general.ask_for_token') }} &#128521;</p>
                <form action="{{ route('cv') }}" method="GET">
                    <div class="row">
                        <div class="col s6">
                            <div class="input-field inline white-text">
                                <!-- If you really want my CV just send me an email. I'll send you a token -->
                                <input name="token" id="token" type="text" class="white-text" autocomplete="off">
                                <label for="token" class="white-text">{{ trans('general.download_token') }}</label>
                            </div>
                        </div>

                        <div class="col s6">
                            <button style="margin-top: 24px" class="btn waves-effect waves-light white black-text" type="submit" name="action">{{ trans('general.download') }}</button>
                        </div>
                    </div>
                </form>
            @else
                <p class="flow-text" style="margin-bottom: 20px">{{ trans('general.invalid_token') }} &#128546;</p>
                <a href="{{ route('home') }}" class="waves-effect waves-light btn black-text white">{{ trans('general.go_back') }}</a>
            @endif
        </section>
        @include('partials.footer')
    </div>
@endsection