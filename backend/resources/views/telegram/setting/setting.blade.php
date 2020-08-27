@extends('telegram.loyauts.index')

@section('content')
    <div class="container">
        @if (\Illuminate\Support\Facades\Session::has('status'))
            <div class="alert alert-info">
                <span>{{ \Illuminate\Support\Facades\Session::get('status') }}</span>
            </div>
        @endif
        <form action="{{ route('telegram.setting.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for=""> URI for Telegram Bot</label>
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"> Действие <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" onclick="document.getElementById('url_callback_bot').
                                    value='{{ url('') }}'">Вставить URI</a></li>
                            <li><a href="#" onclick="event.preventDefault(); document.getElementById('setwebhook').submit();">Отпавить URI</a></li>
                            <li><a href="#" onclick="event.preventDefault(); document.getElementById('getwebhookinfo').submit();">Информация WebHook</a></li>
                        </ul>
                    </div>
                    <input type="url" class="form-control" id="url_callback_bot" name="url_callback_bot"
                           value="{{ $url_callback_bot ?? ''}}">
                </div>
            </div>
            <button class="btn btn-danger" type="submit">Сохранить</button>
        </form>
    </div>

    <form id="setwebhook"  method="POST" action="{{ route('telegram.setting.setwebhook') }}" style="display: none">
        {{ csrf_field() }}
        <input type="hidden" name="url" value="{{ $url_callback_bot ?? '' }}">
    </form>

    <form id="getwebhookinfo"  method="POST" action="{{ route('telegram.setting.getwebhookinfo') }}" style="display: none">
        {{ csrf_field() }}
    </form>
@endsection
