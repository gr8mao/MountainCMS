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
            var data = jQuery.parseJSON(data);

            if(data.pagination){
                $('.pagination').remove();
                $('#userTable').after(data.pagination);
            } else {
                $('.pagination').remove();
            }

            if (data.users.length == 0 && !$('.nouser').length) {
                $('#usersList').empty();
                $('#userTable').after('<h5 class="ui block header nouser">Список пользователей пуст</h5>');
            } else {
                $('#searchField').removeClass('loading');
                $('#usersList').empty();

                data.users.forEach(function (user) {
                    var userItem = '<tr class="user-'+user.user_id+'"> <td class="collapsing">'
                        + '<div class="ui checkbox">'
                        + '<input type="checkbox"> <label></label>'
                        + '</div>'
                        + '</td>'
                        + '<td class="collapsing userId">' + user.user_id + '</td>'
                        + '<td class="userLogin">' + user.user_login + '</td>'
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
                    $('.nouser').remove();
                });
            }
        }
    });
});

$('.deleteUser').on("click",function(){
    var delUserId = $(this).parent().parent().find('.userId').text();
    var delUserLogin = $(this).parent().parent().find('.userLogin').text();
    $('span.delUserLogin').text(delUserLogin);
    $('.modal').modal({
        closable  : false,
        onDeny    : function(){
            $(this).modal('hide');
        },
        onApprove : function() {
            $.ajax({
                method: "POST",
                url: 'users/delete/id'+delUserId,
                success: function(data){
                    if(data == 1){
                        toastr.info('Пользователь '+delUserLogin+' был удален!');
                        $(".userId-"+delUserId).remove();
                    } else {
                        toastr.error('Пользователь не был удален!');
                    }
                },
                error: function(){
                    toastr.error('Запрос не был принят!');
                }

            });
        }
    }).modal('show');
    return false;
});