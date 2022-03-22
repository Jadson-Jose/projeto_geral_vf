//  Hide error mensages
$('#error-message').delay(5000).fadeOut('slow');


// Generate random password
$('#btn-password').click(
    function() {

        let chars = 'abcdefghijklmnopqrstuvxyzwABCDEFGHIJKLMNOPQRSTUVXYZWabcdefghijklmnopqrstuvxyzwABCDEFGHIJKLMNOPQRSTUVXYZW!@#$%^&*()<>?';
        let pass = '';
        let num_chars = 12;

        for (let i = 0; i < num_chars; i++) {
            pass += chars.charAt(Math.floor(Math.random() * chars.length));
        }

        $('input[name=text_password]').val(pass);
        $('input[name=text_repeat_password]').val(pass);
    }
);


$('#btn-limpar').click(
    function() {
        $('input[name=text_password]').val('');
        $('input[name=text_repeat_password]').val('');
    }
);