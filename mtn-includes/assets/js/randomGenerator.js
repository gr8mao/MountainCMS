/**
 * Created by maksimbelov on 02.04.17.
 */

function randomString(n) {
    var result = '';
    var words = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
    var max_position = words.length - 1;
    for (i = 0; i < n; ++i) {
        position = Math.floor(Math.random() * max_position);
        result = result + words.substring(position, position + 1);
    }
    return result;
}


jQuery(document).ready(function () {
    $("#generatePassword").click(function () {
        $("#password").val(randomString(10));
        $('#warningPassword').transition('fade up');
        return false;
    });
});