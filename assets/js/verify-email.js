(function($) {

    'use strict';

    $(document).ready(function() {
        var selectors = {
            verifyCodeForm: '#verify-code-form',
            verifyBtn: '#verify-btn',
            codeInput: '#code',
            showErrorDiv: '#show-error',
            resendConfirmationLink: '#resend_confirmation_link',
            sendingConfirmationMail: '#sending_confirmation_mail'
        };

        $(selectors.verifyBtn).click(function() {
            $(selectors.showErrorDiv).text('');
            
            $(selectors.verifyBtn).removeClass('btn-info')
            .html('Verifying...').prop('disabled', true);

            kudobuzz.ajax(ajaxurl, 'POST', $(selectors.verifyCodeForm).serialize())
            .success(function(data, textStatus, xhr) {
                
                $(selectors.verifyBtn).addClass('btn-info')
                .html('Verify').prop('disabled', false);
                
                var response = JSON.parse(data);
                
                if (response.errors && response.hasOwnProperty('errors')) {
                    $(selectors.showErrorDiv).text(response.errors.msg);
                }

                if (response.data && response.hasOwnProperty('data')) {
                    if (response.data.access_token) {
                        window.location.href = 'admin.php?page=create-business';
                    }

                    if (response.data.msg) {
                        $(selectors.showErrorDiv).html(response.data.msg);
                    }
                    
                }
            })
            .error(function(jqxhr, textStatus, error) {
                $(selectors.showErrorDiv).text('Code couldn\'t be verified'); 
            })
            .always(function (data) {
                $(selectors.verifyBtn).addClass('btn-orange').html('Verify').prop('disabled', false);
            });
        });

        $(selectors.resendConfirmationLink).click(function () { 

            $(selectors.sendingConfirmationMail).removeClass('hide')
            .addClass('alert-info')
                .removeClass('alert-success').html('Sending a new confirmation mail. Please wait...');
            
            kudobuzz.ajax(ajaxurl, 'GET', {'action': 'request_confirmation_email'})
                .success(function (data, textStatus, xhr) {
                    
                    var response = JSON.parse(data);

                    if (response.hasOwnProperty('code') && response.code == 1) { 
                        $(selectors.sendingConfirmationMail).removeClass('hide')
                        .removeClass('alert-info alert-danger')
                        .addClass('alert-success').html('A new confirmation email is sent to '+ response.email + '. Check your inbox.');
                    }

                    if (response.errors && response.hasOwnProperty('errors')) {
                        $(selectors.sendingConfirmationMail)
                            .text(response.errors[0].detail[0].msg)
                            .removeClass('alert-success alert-info')
                            .addClass('alert-danger');
                    }
            })
            .error(function(jqxhr, textStatus, error) {
                $(selectors.showErrorDiv).text('Code couldn\'t be verified'); 
            })
            .always(function (data) {
                $(selectors.verifyBtn).addClass('btn-orange').html('Verify').prop('disabled', false);
            });
        });
    
    });
    
}(jQuery));