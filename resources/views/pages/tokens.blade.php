@extends('layouts.default')

@section('default-head')
    <title>{{ env('APP_NAME') }}</title>
@endsection

@section('default-body')

    @include('partials.particles')
    @include('partials.loading-screen')

    <div class="page">
        <section class="info">
            @if(count($tokens) > 0)
                <table class="white-text">
                    <thead>
                    <tr>
                        <th>{{ trans('general.token', ['token' => ' ']) }}</th>
                        <th>{{ trans('general.downloads') }}</th>
                        <th>{{ trans('general.language') }}</th>
                        <th class="right">{{ trans('general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tokens as $token)
                        <tr>
                            <td>{{ $token->token }}</td>
                            <td class="center"><span>{{ $token->download_count }}/{{ $token->max_download }}</span></td>
                            <td>
                                <img src="https://www.countryflags.io/{{ \App\Http\Controllers\LocaleController::LOCALE_TO_COUNTRY_CODE[$token->locale] }}/flat/32.png">
                            </td>
                            <td class="right">
                                <a style="margin: 2px 2px" class="waves-effect waves-light btn green darken-1 right"
                                   onclick="handleShareToken(this)"
                                   data-token="{{ $token->token }}"
                                   data-message="{{ trans('general.link_copied', ['token' => $token->token]) }}"
                                   data-url="{{ route('cv', ['token' => $token->token]) }}">
                                    <i class="material-icons">share</i>
                                </a>
                                <a style="margin: 2px 2px" class="waves-effect waves-light btn modal-trigger blue right"
                                   href="{{ route('tokens.edit', $token->id) }}">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a style="margin: 2px 2px" class="waves-effect waves-light btn modal-trigger red right"
                                   href="#delete_token_{{ $token->id }}">
                                    <i class="material-icons">delete</i>
                                </a>

                                <div id="delete_token_{{ $token->id }}" class="modal">
                                    <div class="modal-content black-text">
                                        <h3 class="center">{{ trans('general.confirm') }}</h3>
                                        <p class="flow-text black-text center" style="text-shadow: none">{{ trans('general.delete_token_confirm', ['token' => $token->token]) }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form class="center" action="{{ route('tokens.destroy', $token->id) }}" method="POST">
                                            <a href="javascript:void(0);"
                                               class="modal-close waves-effect waves-green btn green">{{ trans('general.cancel') }}</a>
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button class="modal-close waves-effect waves-green btn red" type="submit"
                                                    name="action">{{ trans('general.yes') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="center white-text flow-text">{{ trans('general.no_tokens') }}</p>

                <!-- Tap Target Structure -->
                <div class="tap-target green white-text darken-3" data-target="create_token">
                    <div class="tap-target-content">
                        <h5>{{ trans('general.add_tokens_title') }}</h5>
                        <p>{{ trans('general.add_tokens_text') }}</p>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var elems = document.querySelectorAll('.tap-target');
                        M.TapTarget.init(elems);
                        setTimeout(function () {
                            $('.tap-target').tapTarget('open');
                        }, 500);
                    });
                </script>
            @endif
        </section>
    </div>

    <a id="create_token" href="{{ route('tokens.create') }}" style="position: absolute; bottom: 20px; right: 20px" class="btn-floating btn-large waves-effect waves-light green darken-2"><i class="material-icons">add</i></a>

    @include('partials.footer')

    <script>

        function handleShareToken(element) {
            copyStringToClipboard(element.dataset.url);
            M.toast({html: element.dataset.message, displayLength: 2000});
        }

        function copyStringToClipboard (str) {
            var el = document.createElement('textarea');
            el.value = str;
            el.setAttribute('readonly', '');
            el.style = {position: 'absolute', left: '-9999px'};
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
        }

        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.modal');
            M.Modal.init(elems, {});
        });
    </script>
@endsection