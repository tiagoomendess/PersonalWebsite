@extends('layouts.default')

@section('default-head')
    <title>{{ env('APP_NAME') }}</title>
@endsection

@section('default-body')

    @include('partials.particles')
    @include('partials.loading-screen')

    <div class="page">
        <section class="info">
            <h1>{{ trans('general.create_token') }}</h1>
            @include('partials.token_form', ['errors' => $errors])
        </section>
    </div>

    @include('partials.footer')
@endsection
