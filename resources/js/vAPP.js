export default () => ({
    toastrOptions: {
        timeOut: 8000,
        "showDuration": "1500",
        "hideDuration": "1500",
        "progressBar": true,
        "newestOnTop": true,
    },

    init() {
        console.log('Initialize Default Alpine');
    },

    showLoader(duration = 400) {
        $('#loading-wrapper').slideDown(duration);
    },

    hideLoader(duration = 400) {
        $('#loading-wrapper').slideUp(duration);
    },

    toggleLoader(duration = 400) {
        $('#loading-wrapper').slideToggle(duration);
    },

    toastWarning: function (body, title) {
        toastr.warning(body, title, this.toastrOptions);
    },

    toastError: function (body, title) {
        toastr.error(body, title, this.toastrOptions);
    },

    toastSuccess: function (body, title) {
        toastr.success(body, title, this.toastrOptions);
    },

    toastInfo: function (body, title) {
        toastr.info(body, title, this.toastrOptions);
    },
})
