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
});