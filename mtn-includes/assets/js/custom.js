/**
 * Created by maksimbelov on 02.04.17.
 */

$('.message .close').on('click', function() {
        $(this).closest('.message').transition('fade down');
    });

$('#user_role').on('change', function() {
    if($(this).val() == '1'){
        $('#warningAdmin').transition('fade up');
    } else {
        $('#warningAdmin').transition('hide');
    }
});