@extends('layout')
@section('item', 'link_2')
@section('content')
    @include('setting.script_setting_app')

    <script>
        let url = '{{ Config::get("Global")['ukassa'] }}';
        let accountId = '{{ $accountId }}'
    </script>
    @include('div.alert')
    @isset($message)
        <script>
            let message = @json(($message));
            alertViewByColorName("danger", message)
            window.alert(message)
        </script>
    @endisset
    <div class="p-4 mx-1 mt-1 bg-white rounded py-3">
        @include('div.TopServicePartner')

        <div id="mainMessage" class="mt-2 alert alert-warning alert-dismissible fade show in text-center" style="display: none">  </div>

        <form class="mt-3" action="/Setting/createAuthToken/{{ $accountId }}?isAdmin={{ $isAdmin }}" method="post">
        @csrf <!-- {{ csrf_field() }} -->
            <div class="mb-3 row">
                <label for="token" class="col-3 col-form-label"> Токен учет онлайн кассы </label>
                <div class="col-9">
                    <input id="token" type="text" name="token" placeholder="ключ доступа к Учёт онлайн кассы" class="form-control form-control-orange"
                           required maxlength="255" value="{{ $token }}">
                </div>
            </div>
            <hr>
            <div class='d-flex justify-content-end text-black btnP' >
                <button class="btn btn-outline-dark textHover" data-bs-toggle="modal" data-bs-target="#modal"> Сохранить </button>
            </div>
        </form>
    </div>

    <div class="modal fade bd-example-modal-sm" id="sendTokenByEmailAndPassword" data-bs-keyboard="false" data-bs-backdrop="static"
         tabindex="-1" role="dialog" aria-labelledby="..." aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa-solid fa-handshake text-success"></i> Получить токен учёт онлайн кассы </h5>
                    <div class="close" data-dismiss="modal" aria-label="Close" style="cursor: pointer;"><i class="fa-regular fa-circle-xmark"></i></div>
                </div>
                <div class="modal-body">

                    <div id="message" class="mt-2 alert alert-info alert-dismissible fade show in text-center" style="display: none">  </div>

                    <div class="row">
                        <label class="col-3 col-form-label"> Email </label>
                        <div class="col-9">
                            <input id="sendEmail" type="email" name="email" placeholder=" почта@gmail.com " class="form-control form-control-orange">
                        </div>
                        <label class="col-3 col-form-label"> Пароль </label>
                        <div class="col-9">
                            <div class="input-group">
                            <input id="sendPassword" type="password" name="password" placeholder=" *********** " class="form-control form-control-orange">
                                <div class="input-group-append">
                                    <button onclick="eye_password()" class="btn btn-outline-secondary" type="button"><i class="fa-solid fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer"> <button onclick="sendToken()" type="button" class="btn btn-primary">Получить</button> </div>
            </div>
        </div>
    </div>

    <script>
        let token = window.document.getElementById('token')
        NAME_HEADER_TOP_SERVICE("Настройки → настройки интеграции")
        if (token.value !== ''){

        } else {  sendCollection('show') }
    </script>


@endsection

