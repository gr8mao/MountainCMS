/**
 * Created by maksimbelov on 02.04.17.
 */

$('.message .close').on('click', function () {
    $(this).closest('.message').transition('fade down');
});

$('#user_role').on('change', function () {
    if ($(this).val() == '1') {
        $('#warningAdmin').transition('fade up');
    } else {
        $('#warningAdmin').transition('hide');
    }
});

$('#searchField').on('input', function () {
    var searchString = $(this).val();

    var filter = {"filter": searchString};

    $.ajax({
        method: "POST",
        URL: "",
        data: filter,
        beforeSend: function () {
            $('#searchField').addClass('loading');
        },
        success: function (data) {
            var users = jQuery.parseJSON(data);

            if (users.length == 0 ) {
                $('#usersList').empty().append('<h5>', 'Список пользователей пуст');
            } else {
                $('#searchField').removeClass('loading');
                $('#usersList').empty();
                users.forEach(function (user) {
                    var userItem = '<tr> <td class="collapsing">'
                        + '<div class="ui checkbox">'
                        + '<input type="checkbox"> <label></label>'
                        + '</div>'
                        + '</td>'
                        + '<td>' + user.user_id + '</td>'
                        + '<td>' + user.user_login + '</td>'
                        + '<td>' + user.user_email + '</td>'
                        + '<td>' + user.user_name + ' ' + user.user_surname + '</td>'
                        + '<td>' + user.user_role + '</td>'
                        + '<td class="collapsing">'
                        + '<div class="ui right floated small primary labeled icon button">'
                        + '<i class="user icon"></i> Изменить'
                        + '</div>'
                        + '</td>'
                        + '</tr>';
                    $('#usersList').append(userItem);
                });
            }
        }
    });
});
