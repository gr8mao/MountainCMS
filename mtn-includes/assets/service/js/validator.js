/**
 * Created by maksimbelov on 25.03.17.
 */
jQuery(document).ready(function () {
    jQuery("#loginForm").form({
        on: 'blur',
        fields: {
            username: {
                identifier: 'username',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Пожалуйста, введите имя пользователя'
                    },
                    {
                        type: 'length[4]',
                        prompt: 'Имя пользователя должно содержать не менее 4 символов'
                    },
                    {
                        type: 'regExp',
                        value: '^[a-zA-Z0-9_.]*$',
                        prompt: 'Имя пользователя может содержать только латинские буквы, цифры, _ и .'
                    }
                ]
            },
            password: {
                identifier: 'password',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Пожалуйста, введите пароль'
                    },
                    {
                        type: 'length[6]',
                        prompt: 'Пароль должен содержать не менее 6 символов'
                    }
                ]
            }
        }
    });


    jQuery('#newUserForm').bind('submit', function () {
        var inputLogin = $('#login');
        var inputPassword = $('#password');
        var inputFirstName = $('#firstName');
        var inputSecondName = $('#secondName');
        var inputEmail = $('#email');
        var errors = false;
        var errorsMsgs = [];
        var emailMask = /^[a-z][a-zA-Z0-9_.]*(\.[a-zA-Z][a-zA-Z0-9_.]*)?@[a-z][a-zA-Z-0-9]*\.[a-z]+(\.[a-z]+)?$/;
        var loginMask = /^[a-zA-Z0-9_.]+$/;

        if (inputLogin.val() == '') {
            inputLogin.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Введите логин;');
        } else if (inputLogin.val().length < 4) {
            inputLogin.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Логин не может быть короче 4-х символов');
        } else if (!loginMask.test(inputLogin.val())) {
            inputLogin.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Логин может содержать только заглавные и строчные латинские буквы и цифры, а также символы _ и .');
        } else inputLogin.removeClass('invalid').addClass('valid');

        if (!$(this).hasClass('editForm')) {
            if (inputPassword.val() == '') {
                inputPassword.removeClass('valid').addClass('invalid');
                errors = true;
                errorsMsgs.push('Введите пароль;');
            } else if (inputPassword.val().length < 10) {
                inputPassword.removeClass('valid').addClass('invalid');
                errors = true;
                errorsMsgs.push('Пароль не может быть короче 10 символов;');
            } else inputPassword.removeClass('invalid').addClass('valid');
        }

        if (inputFirstName.val() == '') {
            inputFirstName.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Введите имя пользователя;');
        } else inputFirstName.removeClass('invalid').addClass('valid');

        if (inputSecondName.val() == '') {
            inputSecondName.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Введите фамилию пользователя;');
        } else inputSecondName.removeClass('invalid').addClass('valid');

        if (inputEmail.val() == '') {
            inputEmail.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Введите адрес электронной почты пользователя;');
        } else if (!emailMask.test(inputEmail.val())) {
            inputEmail.removeClass('valid').addClass('invalid');
            errors = true;
            errorsMsgs.push('Неверный формат электронной почты;');
        } else inputEmail.removeClass('invalid').addClass('valid');

        if (errors) {
            jQuery('.errors').css('display', 'block');
            $('.errors .list').empty();
            errorsMsgs.forEach(function (errorMsg) {
                $('.errors .list').append('<div class="item">', errorMsg);
            });

            return false;
        } else {
            var formData = $(this).serialize();
            jQuery('.errors').css('display', 'none');
            $.ajax({
                method: "POST",
                URL: "",
                data: formData,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#loading').hide();
                    if (data == "saved") {
                        $('#successRegistr').show();
                        if (!$(this).hasClass('editForm')) {
                            emptyfy();
                        }
                    } else {
                        var errors = jQuery.parseJSON(data);
                        $('.errors .list').empty();
                        errors.forEach(function (errorMsg) {
                            $('.errors .list').append('<div class="item">', errorMsg);
                        });
                        jQuery('.errors').css('display', 'block');
                    }
                }
            });
        }

        return false;
    });

    jQuery("#editPage,#addPage").form({
        on: 'blur',
        fields: {
            formId: {
                identifier: 'formId',
                rules: [
                    {
                        type: 'empty'
                    }
                ]
            },
            page_title: {
                identifier: 'page_title',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Не задан заголовок страницы'
                    }
                ]
            },
            page_route: {
                identifier: 'page_route',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Введите путь страницы'
                    },
                    {
                        type: 'regExp',
                        value: '^/[a-zA-Z0-9_]*$',
                        prompt: 'Неверный формать пути. Путь может содержать только латинские буквы, цифры и _'
                    }
                ]
            },
            page_status: {
                identifier: 'page_status',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Не указан статус'
                    }
                ]
            },
            page_template: {
                identifier: 'page_template',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Не указан шаблон'
                    }
                ]
            }
        }
    });

    jQuery("#addFile").form({
        on: 'blur',
        fields: {
            formId: {
                identifier: 'formId',
                rules: [
                    {
                        type: 'empty'
                    }
                ]
            },
            file_name: {
                identifier: 'file_name',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Не задано имя файла'
                    },
                    {
                        type: 'regExp',
                        value: '^[a-zA-Z0-9_]*$',
                        prompt: 'Имя файла может содержать только латинские буквы, цифры и _'
                    }
                ]
            }
        }
    });

});

function emptyfy() {
    $('input[type="text"],input[type="password"],input[type="email"],input[type="search"]').each(function () {
        $(this).val('');
        $(this).removeClass('invalid').removeClass('valid');
    });
}