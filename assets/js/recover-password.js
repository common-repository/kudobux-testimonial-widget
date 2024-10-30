(function($) {
    'use strict';

    $(document).ready(function() {
        var selectors = {
            recoverPasswordBtn: '#recover-password-btn',
            recoverPasswordForm: '#recover-password-form',
            newPasswordForm: '#new-password-form',
            savePasswordBtn: '#save-password-btn',
            showErrorDiv: '.show-error',
            verifyTokenDiv: '#verify-token-div',
            sendEmailDiv: '#send-email-div'
        };

        var showNewPasswordForm = function () {
            $(selectors.newPasswordForm).show();
            $(selectors.verifyTokenDiv).show();
        };

        var hideRecoverPasswordForm = function () {
            $(selectors.recoverPasswordForm).hide();
            $(selectors.sendEmailDiv).hide();
        };

        $(selectors.newPasswordForm).hide();
        $(selectors.verifyTokenDiv).hide();

        /**
         * Check if token is sent to user to be used to reset his/her password
         */
        var checkTokenSent = function() {
            if (kudobuzz.getUrlParam('email_sent') === 'true') {
                hideRecoverPasswordForm();
                showNewPasswordForm();  
            }
        };

        checkTokenSent();

        /**
         * Send verification token
         */
        $(selectors.recoverPasswordForm).validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            submitHandler: function (form) {
                $(selectors.recoverPasswordBtn).removeClass('btn-orange')
                .html('Please Wait...').prop('disabled', false);
                $(selectors.showErrorDiv).hide();

                kudobuzz.ajax(ajaxurl, 'POST', $(selectors.recoverPasswordForm).serialize())
                .success(function(data, textStatus, jqxhr) {
                    $(selectors.recoverPasswordBtn).addClass('btn-orange')
                    .html('Recover Password').prop('disabled', false);
                    
                    var response;
                    
                    if (data !== '') {
                        response = JSON.parse(data);
                    } else {
                        hideRecoverPasswordForm();
                        showNewPasswordForm();
                        history.replaceState('', '', 'admin.php?page=recover-password&email_sent=true');
                    }
                    
                    if (typeof response !== 'undefined') {
                        $(selectors.showErrorDiv).text(response.errors[0].detail[0].msg).show();
                    }
                }) 
                .error(function(jqxhr, textStatus, error) {
                    $(selectors.showErrorDiv).text('Mail couldn\'t be sent. Try again. Please contact support if this persists.'); 
                })
                .always(function () {
                    $(selectors.recoverPasswordBtn).addClass('btn-orange').html('Recover Password').prop('disabled', false);
                });
            }
        });

        /**
         * Save new password
         */
        $(selectors.newPasswordForm).validate({
            rules: {
                token: {
                    required: true
                },
                newPassword: {
                    required: true
                },
                retypePassword: {
                    required: true,
                    equalTo: "#password"
                }
            },
            submitHandler: function (form) {
                $(selectors.savePasswordBtn).removeClass('btn-orange')
                .html('Please Wait...').prop('disabled', false);

                kudobuzz.ajax(ajaxurl, 'POST', $(selectors.newPasswordForm).serialize())
                .success(function(data, textStatus, jqxhr) {

                    if (data !== '') {
                        var response = JSON.parse(data);

                        if (response.errors) {
                            $(selectors.showErrorDiv).text(response.errors[0].detail[0].msg);
                        }
                    } else {
                        window.location.href = "admin.php?page=login";
                    }
                }) 
                .error(function(jqxhr, textStatus, error) {
                    $(selectors.showErrorDiv).text('Couldn\'t verify token. Try again. Please contact support if this persists.');
                })
                .always(function () {
                    $(selectors.verifyTokenBtn).addClass('btn-orange').html('Verify Token').prop('disabled', false).show();
                });
            }
        });
    });
}(jQuery));