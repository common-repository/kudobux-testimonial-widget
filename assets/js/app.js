(function($) {
    'use strict';

    if (undefined === window.kudobuzz) {
        window.kudobuzz = {};
    }

    kudobuzz.ajax = function(endpoint, method, payload) {
        return $.ajax({
            type: method,
            url: endpoint,
            data: payload
        });
    }; 

    /**
    * Get a named param from url
    * 
    * @param {*} name 
    * @param {*} url 
    */
    kudobuzz.getUrlParam = function(name, url) {
        if (!url) {
            url = window.location.href;
        }

        var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(url);

        if (!results) { 
            return undefined;
        }

        return results[1] || undefined;
    };

    /**
     * check if object has sub property
     * @param {*} obj 
     * @param {*} key 
     */
    kudobuzz.hasSubProperty = function (obj, key) {
        return key.split(".").reduce(function (o, x) {
            return (typeof o == "undefined" || o === null) ? o : o[x];
        }, obj);
    };
}(window.jQuery));