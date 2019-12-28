@extends('layouts.default')

@section('default-head')
    <title>{{ env('APP_NAME') }}</title>
@endsection

@section('default-body')

    @include('partials.particles')
    @include('partials.loading-screen')

    <div class="page">
        <section class="info">
            <h1>{{ trans('general.token', ['token' => $token->token]) }}</h1>
            @include('partials.token_form', [
                'route' => route('tokens.update', $token->id),
                'method' => 'PUT',
                'tokenId' => $token->id,
                'token' => $token->token,
                'download_count' => $token->download_count,
                'max_download' => $token->max_download,
                'tokenLocale' => $token->locale,
                'errors' => $errors
            ])
        </section>
    </div>

    @include('partials.footer')

@endsection