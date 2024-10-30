(function($) {
    'use strict';

    $(document).ready(function() {
        var selectors = {
            'installWidgetBtn': '#install-widget-btn',
            'installWidgetForm': '#install-widget-form',
            'showErrorDiv': '#error'
        };

        var installWidget = function() {
            $(selectors.installWidgetBtn).removeClass('btn-success')
            .html('Installing Widget...').prop('disabled', true);

            kudobuzz.ajax(ajaxurl, 'POST', $(selectors.installWidgetForm).serialize())
            .success(function(data, textStatus, jqxhr) {
                $(selectors.installWidgetBtn).addClass('btn-success')
                .html('Install Review Widget').prop('disabled', false);

                window.location.href = "admin.php?page=dashboard";
            }) 
            .error(function(jqxhr, textStatus, error) {
                $(selectors.showErrorDiv).text('Couldn\'t install widget. Try again. Please contact support if this persists.');                 
            })
            .always(function () {
                $(selectors.installWidgetBtn).addClass('btn-success')
                .html('Install Review Widget').prop('disabled', false);
            });
        };

        $(document.body).on('click', selectors.installWidgetBtn, installWidget);
    });

}(jQuery));