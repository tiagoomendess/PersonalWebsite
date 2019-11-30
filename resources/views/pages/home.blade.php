@extends('layouts.default')

@section('default-head')
    <title>{{ env('APP_NAME') }}</title>
@endsection

@section('default-body')

    @include('partials.particles')
    @include('partials.loading-screen')

    <div class="page">
        <section class="info">

            <h1>{{ config('custom.first_and_last_name') }}</h1>

            <div class="sub-info">
                <p class="flow-text center"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ trans('general.hometown') }}</p>
                <!-- Maybe there's a hidden endpoint somewhere -->
                <p class="flow-text center"><a href="mailto:tiago@mendes.com.pt"><i class="fas fa-envelope"
                                                                             aria-hidden="true"></i> {{ config('custom.contact_email') }}
                    </a>
                </p>
                <p class="flow-text center"><i class="fa fa-graduation-cap" aria-hidden="true"></i> {{ trans('general.degree') }}
                </p>
                <p class="flow-text center"><i class="fa fa-language" aria-hidden="true"></i> {{ trans('general.languages') }}</p>
                <p class="flow-text center"><i class="fa fa-birthday-cake"
                                        aria-hidden="true"></i> {{ trans('general.age', ['age' => $age]) }}</p>
            </div>
            <div class="out-btn-links">
                <a href="https://linkedin.com/in/tiago-sousa-mendes" target="_blank">
                    <i class="fab fa-linkedin"></i>
                </a>

                <a href="https://github.com/tiagoomendess" target="_blank">
                    <i class="fab fa-github-square"></i>
                </a>
            </div>

        </section>
        @include('partials.footer')
    </div>
@endsection