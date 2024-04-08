$(document).ready(function() {
    $('#form-cadastro').submit(function(event) {
        event.preventDefault();
        var email = $('#email').val();
        $.ajax({
            type: 'POST',
            url: 'verificar_email.php',
            data: { email: email },
            success: function(response) {
                $('#resultado').text(response);
            }
        });
    });
});
