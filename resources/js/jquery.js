console.log('here1');
$(document)
    .ajaxStart(function () {
        vAPP.showLoader();
    })
    .ajaxStop(function () {
        vAPP.hideLoader();
    })
    .ajaxSuccess(function () {
        initAfterAjax();
    })
    .ajaxError(function (event, jqxhr, settings, thrownError) {
        if (jqxhr.status == 401) {
            window.location = window.location;
        }
        else if (jqxhr.status == 419) { // -- token mismatch, reload page and try again
            vAPP.toastError('token mismatch, reload page and try again');
        }
        else if (jqxhr.status == 422) { // -- validation error
            console.log('AJAX reqest status : ' + jqxhr.status);

            var errors = JSON.parse(jqxhr.responseText);
            vAPP.toastError(errors.message);
        }
        else {
            console.log('AJAX reqest status : ' + jqxhr.status);
        }
    });

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
        // initVue();
        initAfterAjax();
    })
    .keydown(function (event) {
        if (event.which == "17") {
            ctrlPressed = true;
        }
    })
    .keyup(function () {
        ctrlPressed = false;
    });
console.log('here2');

$.fn.filterByData = function (prop, val) {
    var $self = this;
    if (typeof val === 'undefined') {
        return $self.filter(
            function () { return typeof $(this).data(prop) !== 'undefined'; }
        );
    }
    return $self.filter(
        function () { return $(this).data(prop) == val; }
    );
};