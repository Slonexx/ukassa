@extends('layout')
@section('item', 'link_3')
@section('content')

    <div class="p-4 mx-1 mt-1 bg-white rounded py-3">
        @include('div.TopServicePartner')

        @isset($message)
            <div class="mt-2 alert alert-danger alert-dismissible fade show in text-center "> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endisset

        <form class="mt-3" action="/Setting/Kassa/{{ $accountId }}?isAdmin={{ $isAdmin }}" method="post">
        @csrf <!-- {{ csrf_field() }} -->
            <div class="mb-3 row">
                <label for="token" class="col-3 col-form-label"> Выберите кассу </label>
                <div class="col-6">
                    <select id="idKassa" name="idKassa" class="form-select text-black" onchange="get_is_activated()">
                    </select>
                </div>
                <div id="is_activated" class="col-3 p-1 col-form-label text-center rounded"></div>
            </div>

            <div class="mb-3 row">
                <label for="token" class="col-3 col-form-label"> Выберите Отдел/Секцию </label>
                <div class="col-9">
                    <select id="idDepartment" name="idDepartment" class="form-select text-black" onchange="getDepartment()">
                    </select>
                </div>
            </div>

            <hr>
            <div class='d-flex justify-content-end text-black btnP' >
                <button class="btn btn-outline-dark textHover" data-bs-toggle="modal" data-bs-target="#modal"> Сохранить </button>
            </div>
        </form>
    </div>

    <script>
        NAME_HEADER_TOP_SERVICE("Настройки → касса")
        let url = '{{Config::get("Global")['ukassa']}}';
        let accountId = '{{ $accountId }}'
        let kassa = @json($kassa);
        let department = @json($department);
        let saveKassa = "{{$saveKassa}}";
        let saveDepartment = "{{$saveDepartment}}";


        if (kassa.length > 0) {
            kassa.forEach(function (item){
                let option1 = document.createElement("option")
                option1.text = item.name
                option1.value = item.id
                idKassa.appendChild(option1)
            })
            get_is_activated()
        }
        if (saveKassa != null) idKassa.value = saveKassa

        if (department.length > 0) {
            department.forEach(function (item){
                let option1 = document.createElement("option")
                option1.text = item.name_ru
                option1.value = item.id
                idDepartment.appendChild(option1)
            })
        }

        if (saveDepartment != null) idDepartment.value = saveDepartment


        get_is_activated()

        function get_is_activated(){
            let select = window.document.getElementById('idKassa')
            let option = select.options[select.selectedIndex];
            let kassaID = option.value;


            let index = 0;
            while (index < kassa.length){
                if (kassa[index].id == kassaID) {
                    if (kassa[index].is_activated == true ){
                        window.document.getElementById('is_activated').innerText = "активирована"
                        window.document.getElementById('is_activated').classList.add('bg-success')
                        window.document.getElementById('is_activated').classList.add('text-white')
                    } else {
                        window.document.getElementById('is_activated').classList.add('bg-danger')
                        window.document.getElementById('is_activated').innerText = "не активирована"
                    }


                }
                index++ }
        }

    </script>

@endsection

