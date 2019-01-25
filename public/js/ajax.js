(function (root, factory) {
    root.ajax = factory(root);
})(this, function (root) {

    'use strict';

    var exports = {};

    var config = {
        contentType: 'application/x-www-form-urlencoded'
    };

    var parse = function (req) {
        var result;
        try {
            result = JSON.parse(req.responseText);
        } catch (e) {
            result = req.responseText;
        }
        return [result, req];
    };

    var xhr = function (type, url, data) {
        var methods = {
            success: function () {
            },
            error: function () {
            },
            always: function () {
            }
        };
        var XHR = root.XMLHttpRequest || ActiveXObject;
        var request = new XHR('MSXML2.XMLHTTP.3.0');

        request.open(type, url, true);
        // request.setRequestHeader('Content-type', config.contentType);
        request.onreadystatechange = function () {
            var req;
            if (request.readyState === 4) {
                req = parse(request);
                if (request.status >= 200 && request.status < 300) {
                    methods.success.apply(methods, req);
                } else {
                    methods.error.apply(methods, req);
                }
                methods.always.apply(methods, req);
            }
        };
        request.send(data);

        var promissXhr = {
            success: function (callback) {
                methods.success = callback;
                return promissXhr;
            },
            error: function (callback) {
                methods.error = callback;
                return promissXhr;
            },
            always: function (callback) {
                methods.always = callback;
                return promissXhr;
            }
        };

        return promissXhr;
    };

    exports.get = function (src) {
        return xhr('GET', src);
    };

    exports.put = function (url, data) {
        return xhr('PUT', url, data);
    };

    exports.post = function (url, data) {
        return xhr('POST', url, data);
    };

    exports.delete = function (url) {
        return xhr('DELETE', url);
    };

    exports.setContentType = function (value) {
        config.contentType = value;
    };

    return exports;

});