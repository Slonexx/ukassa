<script>
    /*СКРИПТ ОСНОВНОГО (АУНТИФИКАЦИИ, ПОЛУЧЕНИЕ ТОКЕНА)*/
    function sendToken(){
        let email = document.getElementById('sendEmail')
        let password = document.getElementById('sendPassword')
        let message = document.getElementById('message')

        if (email.value === '' || password.value === '' ){
            message.innerText = 'Введите логин или пароль'
            message.style.display = 'block'
        } else {
            message.innerText = ''
            message.style.display = 'none'

            let settings = ajax_settings(url + 'get/createAuthToken/'+ accountId, "GET", { email: email.value, password: password.value })
            console.log(url + 'get/createAuthToken/'+ accountId + ' settings ↓ ')
            console.log(settings)
            $.ajax(settings).done(function (json) {
                console.log(url + 'get/createAuthToken/' + accountId + ' response ↓ ')
                console.log(json)

                if (json.status === 200) {
                    message.style.display = 'none'
                    window.document.getElementById('token').value = json.auth_token
                    window.document.getElementById('mainMessage').innerText = json.full_name + ' ваш токен создан, не забудьте нажать на кнопку сохранить'
                    window.document.getElementById('mainMessage').style.display = 'block'
                    $('.close').click();
                } else {
                    message.innerText = 'Не верный email или пароль'
                    message.style.display = 'block'
                }
            })

        }
    }

    function eye_password(){
        let input = document.getElementById('sendPassword')
        if (input.type === "password"){
            input.type = "text"
        } else {
            input.type = "password"
        }
    }
    function sendCollection(hideOrShow){
        if (hideOrShow === 'show') {
            $('#sendTokenByEmailAndPassword').modal({backdrop: 'static', keyboard: false})
            $('#sendTokenByEmailAndPassword').modal('show')
        }

        if (hideOrShow === 'hide') {
            $('#sendTokenByEmailAndPassword').modal('hide')
        }
    }

    function ajax_settings(url, method, data){
        return {
            "url": url,
            "method": "GET",
            "timeout": 0,
            "headers": {"Content-Type": "application/json",},
            "data": data,
        }
    }






    /*СКРИПТ ДОКУМЕЕТОВ ()*/
    function loading(createDocument, payment_type){
        window.document.getElementById('createDocument_asWay').value = createDocument
        window.document.getElementById('payment_type').value = payment_type
    }

</script>
