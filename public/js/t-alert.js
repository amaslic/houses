!function($) {
    "use strict";
    toastr.options = {
        "debug": false,
        "newestOnTop": false,
        "positionClass": "toast-top-right",
        "closeButton": true,
        "progressBar": true
    };
    $('.homerDemo1').on('click', function (event) {
        toastr.info('Info - This is a custom info notification');
    });
    $('.homerDemo2').on('click', function (event) {
        toastr.success('Success - This is a success notification');
    });
    $('.homerDemo3').on('click', function (event) {
        toastr.warning('Click on the map to create a marker!');
    });
    $('.homerDemo4').on('click', function (event) {
        toastr.error('Error - This is a error notification');
    });
}(window.jQuery);