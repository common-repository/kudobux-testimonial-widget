(function($) {
    
    'use strict';

    $(document).ready(function() {
        var selectors = {
            showErrorDiv: '#show-error',
            loginForm: '#login-form',
            requestFeedbackDiv: '#request-feedback',
            forgotPasswordLink: '#forgot-password-link',
            loginBtn: '#login-btn'
        };

        $(selectors.loginForm).validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            submitHandler: function (form) {
                $(selectors.loginBtn).removeClass('btn-orange')
                .html('Please Wait...').prop('disabled', true);
                
                makeRequest(ajaxurl, 'POST', $(selectors.loginForm).serialize())
                .success(function(data, textStatus, jqxhr) {
                    
                    var response = JSON.parse(data);

                    if (response.hasOwnProperty('code') && response.code === 'no_business_found') { 
                        window.location.href = "admin.php?page=create-business";
                    }

                    if (response.data && response.hasOwnProperty('data')) {
                        window.location.href = "admin.php?page=install-widget";
                    }
                }) 
                .error(function(jqxhr, textStatus, error) {
                    $(selectors.showErrorDiv).text('Your account wasn\'t created. Try again. Please contact support if this persists.'); 
                })
                .always(function () {
                    $(selectors.loginBtn).addClass('btn-orange').html('Login').prop('disabled', false);
                });
            }
        });

        $(document.body).on('click', selectors.forgotPasswordLink, function() {
            window.location.href = 'admin.php?page=recover-password';
        });
    });

    var makeRequest = function(endpoint, method, payload) {
        return $.ajax({
            type: method,
            url: endpoint,
            data: payload
        });
    };
    
}(jQuery));