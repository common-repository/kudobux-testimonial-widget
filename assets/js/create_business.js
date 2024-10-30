(function($) {
    var selectors = {
            urlInput: '#url',
            newBusinessForm: '#new_business_form',
            platform: '#platform',
            brandInput: '#brand',
            validationStatusResult: '.validation_status_result',
            numberOfYearsClass: '.number_of_years',
            siteIsRunClass: '.site_is_run',
            howSiteIsRun: '#how_site_is_run',
            userId : '#user_id',
            businessId: '#business_id',
            newBusinessBtn: '#new_bz_btn'
        },
        numberOfYears = '< 1',
        howSiteIsRun = 'full time',
        businessId = $(selectors.businessId).val();

    $(selectors.urlInput).focus();

    /**
     * Validate business form
     */
    $(selectors.newBusinessForm).validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            url: {
                required: true,
                url: true
            },
            brand: {
                required: true,
                minlength: 5,
            }
        }
    });

    /**
     * Create a new business
     */
    var createNewBusiness = function () {
        if ($(selectors.newBusinessForm).valid()) {
            $('#new_bz_btn')
                .html('Please Wait ....')
                .prop('disabled', true);

            var url = $(selectors.urlInput).val(),
                userId  = $(selectors.userId).val();
            dataLayer.push({
                'event': 'questions_answered',
                'user_id': userId,
                'business_id' : businessId,
                'what_is_your_website_platform': 'wordpress',
                'what_is_your_website_domain': url,
                'how_many_years_have_you_been_selling': numberOfYears ,
                'how_do_you_run_this_website':  howSiteIsRun
            });

           location.href = 'admin.php?page=dash';
        }
    };

    extractHostname = function(url) {
        var hostname;
        //find & remove protocol (http, ftp, etc.) and get hostname

        if (url.indexOf("://") > -1) {
            hostname = url.split('/')[2];
        } else {
            hostname = url.split('/')[0];
        }

        //find & remove port number
        hostname = hostname.split(':')[0];
        //find & remove "?"
        hostname = hostname.split('?')[0];

        return hostname;
    };


    /**
     * Set brand name when url input loses focus
     */
    var setBrandName = function () {
        var url = $(this).val();
        var domain = extractRootDomain(url);
        var parsedDomain = domain.split('.');
        $(selectors.brandInput).val(parsedDomain[0]);
    };

    var extractRootDomain = function(url) {
        var domain =  extractHostname(url),
            splitArr = domain.split('.'),
            arrLen = splitArr.length;

        //extracting the root domain here
        if (arrLen > 2) {
            domain = splitArr[arrLen - 2] + '.' + splitArr[arrLen - 1];
        }

        return domain;
    };


    /**
     * Check for validity of the url provided
     */
    var validUrl = function () {
        var string = $(selectors.urlInput).val();

        if (!~string.indexOf("http")) {
            string = "http://" + string;
        }

        url.value = string;

        return url;
    };

    var customRadioHighlight = function(options){
        $(options.class).on('click',function(e){
            $(options.class).removeClass('active');
            $('#'+e.target.id).addClass('active');
        });
    };

    /* setting the clicked button to active..(Changing the background color)
     * function can be located in common.js
     */
    $(selectors.numberOfYearsClass).click(customRadioHighlight({'class': selectors.numberOfYearsClass}));
    $(selectors.siteIsRunClass).click(customRadioHighlight({'class': selectors.siteIsRunClass}));


    /**
     * Gettting value attached to button
     */
    $(selectors.numberOfYearsClass).on('click', function() {
        numberOfYears = $('#'+event.target.id).attr('data-value');
    });

    $(selectors.siteIsRunClass).on('click', function() {
        howSiteIsRun = $('#'+event.target.id).attr('data-value');
    });

    $(selectors.urlInput).blur(setBrandName);
    $(selectors.urlInput).change(validUrl);
    $(document.body).on('click', selectors.newBusinessBtn, createNewBusiness);
})(window.jQuery);
