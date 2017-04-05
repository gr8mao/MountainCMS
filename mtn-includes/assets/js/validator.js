/**
 * Created by maksimbelov on 25.03.17.
 */
jQuery(document).ready(function(){
    jQuery("#loginForm").bind('submit', function() {
        var nameInput = jQuery('#username');
        var passwordInput = jQuery('#password');
        var errors = false;
        var errorsMsgs = [];

        if(nameInput.val() == ''){
            nameInput.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Введите ваш логин!')
        } else nameInput.removeClass('invalid').addClass('valid');


        if(passwordInput.val() == ''){
            passwordInput.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Введите ваш пароль!')
        } else passwordInput.removeClass('invalid').addClass('valid');

        if(errors) {
            jQuery('.errors').css('display','block');
            $('.errors .list').empty();
            errorsMsgs.forEach(function(errorMsg){
                $('.errors .list').append('<div class="item">',errorMsg);
            });

            return false;
        } else {
            jQuery('.errors').css('display','none');
        }

    });

    jQuery('#newUserForm').bind('submit', function(){
        var inputLogin = $('#login');
        var inputPassword = $('#password');
        var inputFirstName = $('#firstName');
        var inputSecondName = $('#secondName');
        var inputEmail = $('#email');
        var errors = false;
        var errorsMsgs = [];
        var emailMask = /^[a-z][a-zA-Z0-9_.]*(\.[a-zA-Z][a-zA-Z0-9_.]*)?@[a-z][a-zA-Z-0-9]*\.[a-z]+(\.[a-z]+)?$/;

        if(inputLogin.val() == ''){
            inputLogin.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Введите логин;');
        } else if (inputLogin.val().length < 4){
            inputLogin.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Логин не может быть короче 4-х символов');
        } else inputLogin.removeClass('invalid').addClass('valid');

        if(inputPassword.val() == ''){
            inputPassword.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Введите пароль;');
        } else if (inputPassword.val().length < 10){
            inputPassword.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Пароль не может быть короче 10 символов;');
        } else inputPassword.removeClass('invalid').addClass('valid');

        if(inputFirstName.val() == ''){
            inputFirstName.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Введите имя пользователя;');
        } else inputFirstName.removeClass('invalid').addClass('valid');

        if(inputSecondName.val() == ''){
            inputSecondName.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Введите фамилию пользователя;');
        } else inputSecondName.removeClass('invalid').addClass('valid');

        if(inputEmail.val() == ''){
            inputEmail.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Введите адрес электронной почты пользователя;');
        } else if (!emailMask.test(inputEmail.val())){
            inputEmail.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Неверный формат электронной почты;');
        } else inputEmail.removeClass('invalid').addClass('valid');

        if(errors) {
            jQuery('.errors').css('display','block');
            $('.errors .list').empty();
            errorsMsgs.forEach(function(errorMsg){
                $('.errors .list').append('<div class="item">',errorMsg);
            });

            return false;
        } else {
            var formData = $(this).serialize();
            jQuery('.errors').css('display','none');
            $.ajax({
                method: "POST",
                URL: "",
                data: formData,
                beforeSend: function(){
                    $('#loading').show();
                },
                success: function(data){
                    $('#loading').hide();
                    if(data == "saved") {
                        emptyfy();
                        $('#successRegistr').show();
                    } else {
                        var errors = jQuery.parseJSON(data);
                        $('.errors .list').empty();
                        errors.forEach(function(errorMsg){
                            $('.errors .list').append('<div class="item">',errorMsg);
                        });
                        jQuery('.errors').css('display','block');
                    }
                }
            });
        }

        return false;
    })
});

function emptyfy(){
    $('input[type="text"],input[type="password"],input[type="email"],input[type="search"]').each(function(){
        $(this).val('');
        $(this).removeClass('invalid').removeClass('valid');
    });
}