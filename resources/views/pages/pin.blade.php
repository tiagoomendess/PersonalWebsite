@extends('layouts.default')

@section('default-head')
    <title>{{ env('APP_NAME') }}</title>
@endsection

@section('default-body')

    @include('partials.particles')
    @include('partials.loading-screen')

    <div class="page">
        <section class="info">
            <p class="white-text flow-text center">{{ trans('general.pin_protected') }}</p>
            <form action="{{ route('set_pin') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col s12 token-form">
                        <div class="input-field inline white-text" style="margin-right: 5px">
                            <input name="pin" id="pin" type="number" class="white-text" autocomplete="off">
                            <input type="hidden" name="redirect" value="{{ $redirect }}">
                            <label for="pin" class="white-text">{{ trans('general.pin') }}</label>
                        </div>
                        <button class="btn waves-effect waves-light white black-text" type="submit"
                                name="action">{{ trans('general.ok') }}</button>
                    </div>
                </div>
            </form>
            <div>
                <a href="{{ route('home') }}" class="waves-effect waves-light btn white black-text"><i class="material-icons left">arrow_back</i>{{ trans('general.go_back') }}</a>
            </div>
        </section>
    </div>
@endsection